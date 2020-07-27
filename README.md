# Technical Test

## Tasks
1. Create an Application that connects to MySQL
2. Create a routine that receive: Range Date, Status and Location (The fields must be optional to the final user) and return the list of invoices with the following information: Location name, date, status and total value.
3. Create a routine that receive the location id and return the sum of values grouped by status.
4. Create a simple list page to show the result

## Info
- The structure or the DB with some examples can be find on /dump
- Use the framework of your preference
- Submit your code via pull request
- List on README.md all files with your own code

Good luck :)

# Comments from Tracey
I decided to use Laravel for the first time, so took longer than planned.
I know it doesn't look great but I think it does what is required.
Given more time I would add more error checking, and try/catches etc.
I would like to use something like zend for the SQL.


My files are:

   tjfl1/app/Http/Controllers/KitchenCutController.php
   tjfl1/resources/views/kitchencut.blade.php
   tjfl1/resources/views/kitchencut_daterange.blade.php
   tjfl1/resources/views/kitchencut_location_sum.blade.php

I modified this one:

   dump/base.sql

