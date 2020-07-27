<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
#use App\User;

class KitchenCutController extends Controller
{


    public function index() {
        $this->dateRange();
    }

    /**
     * If not a submit request display form with options for user to pick from
     * if a submit request get the data and display
     */
    public function dateRange(Request $request){

        $page = [];
    
        // Has the user clicked submit ?
        if (isset($_GET['submit'])){

            // Get any values that have been selected
            $status    = $request->input('status') ?? null;
            $startDate = $request->input('start_date') ?? null;
            $endDate   = $request->input('end_date') ?? null;
            $location  = $request->input('location') ?? null;

            // Use the values to get our resuls
            $page['results'] = $this->dateRangeGetData($startDate, $endDate, $status, $location);
        }
        else {
            // Get values to display for the user to choose from
            // Then set in the page values
            $page['location_values'] = $this->getLocations();
            $page['status_values']   = $this->getStatuses();
            $page['date_values']           = $this->getDates();

        }

        return view('kitchencut_daterange', $page  );

    }


    /**
     * Get data based on criteria and display
     *
     * @param  startDate @optional
     * @param  endDate   @optional
     * @param  status    @optional
     * @param  location  @optional
     *
     * @return View
     */
    private function dateRangeGetData(string $startDate = null, string $endDate = null, string $status = null, string $location = null )
    {

            // Build up our where clause if we need to.
            $where = null;

            if( !empty($status ) ) {
                $where[] = '( status  = ? )';
                $values[] = $status;
            }
            if( !empty($location ) ) {
                $where[] = '( location_id  = ? )';
                $values[] = $location;
            }
            if( !empty($startDate ) ) {
                // @TODO - Should check date is in valid format eg: YYYY-MM-DD
                $where[] = '( date  >=  ? )';
                $values[] = $startDate;
            }
            if( !empty($endDate ) ) {
                // @TODO - Should check date is in valid format eg: YYYY-MM-DD
                $where[] = '( date <=  ? )';
                $values[] = $endDate;
            }

            $whereClause = '';
            if( !empty($where) ) {
             $whereString =   implode(" AND ", $where);
             $whereClause  = 'WHERE ' .  $whereString;
            
            }


            $results = DB::select('SELECT ih.id as invoice_id, status, SUM(value) AS total, date , locations.name as location_name
                                   FROM invoice_lines il
                                   LEFT join invoice_headers ih ON il.invoice_header_id = ih.id 
                                   LEFT join locations ON ih.location_id = locations.id '  . $whereClause . 
                                   ' GROUP BY invoice_id ASC', $values ?? []);

            return $results;
    }

    /**
     * Get data based on criteria and display
     *
     * @param  startDate @optional
     * @param  endDate   @optional
     * @param  status    @optional
     * @param  location  @optional
     *
     * @return View
     */
    public function location() {

        // Get location values to display
        $locations = $this->getLocations();

        return view('kitchencut_location_sum', ['locations' => $locations ]);

    }

    /**
     * Get locations
     *
     * @return array of objects
     */
    private function getLocations() : ?array {
        return DB::select('SELECT id, name FROM locations ORDER BY name ASC');
    }

    /**
     * Get unique staus
     *
     * @return array of objects
     */
    private function getStatuses() : ?array {
        return DB::select('SELECT DISTINCT status FROM invoice_headers ORDER BY status ASC');
    }

    /**
     * Get unique dates
     *
     * @return array of objects
     */
    private function getDates() : ?array {
        return DB::select('SELECT DISTINCT date FROM invoice_headers ORDER BY date DESC');
    }


    /**
     * Return sum on values by locationId
     *
     * @param string $locationId 
     *
     * @return View
     */
    public function locationSum(string $locationId = null )
    {

        // Check valid int 
        if ( filter_var($locationId, FILTER_VALIDATE_INT)) {
        
            $results = DB::select('SELECT status, SUM(value) AS total 
                                   FROM invoice_lines il
                                   LEFT join invoice_headers ih ON il.invoice_header_id = ih.id
                                   WHERE location_id = ? 
                                   GROUP BY status asc', [$locationId]);
            }
        else {
                // Log as error and can send error message to view as well if required
                $error = 'Invalid location provided';
                $results = null;
        }

        return view('kitchencut_location_sum', ['results' => $results, 'location_id' => $locationId ?? 'No location set' , 'error' => $error ?? null  ]);
    }
}
