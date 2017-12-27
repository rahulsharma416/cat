<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 100,'total_amount' => 150,
            'amount_paid' => 50,'amount_paid_date' => '2017-01-01 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 200,'total_amount' => 250,
            'amount_paid' => 50,'amount_paid_date' => '2017-02-10 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 300,'total_amount' => 350,
            'amount_paid' => 50,'amount_paid_date' => '2017-03-22 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 400,'total_amount' => 450,
            'amount_paid' => 50,'amount_paid_date' => '2017-03-15 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 500,'total_amount' => 550,
            'amount_paid' => 50,'amount_paid_date' => '2017-12-10 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 600,'total_amount' => 650,
            'amount_paid' => 50,'amount_paid_date' => '2017-07-09 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 700,'total_amount' => 750,
            'amount_paid' => 50,'amount_paid_date' => '2017-05-17 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 800,'total_amount' => 850,
            'amount_paid' => 50,'amount_paid_date' => '2017-02-18 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 900,'total_amount' => 950,
            'amount_paid' => 50,'amount_paid_date' => '2017-05-11 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 1000,'total_amount' => 1050,
            'amount_paid' => 50,'amount_paid_date' => '2017-10-24 00:00:00',]);

        
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 2000,'total_amount' => 3000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-01-10 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 3000,'total_amount' => 4000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-09-22 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 4000,'total_amount' => 5000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-08-27 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 5000,'total_amount' => 6000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-03-30 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 6000,'total_amount' => 7000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-05-25 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 7000,'total_amount' => 8000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-01-28 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 8000,'total_amount' => 9000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-02-28 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 9000,'total_amount' => 10000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-05-03 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 10000,'total_amount' => 11000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-12-07 00:00:00',]);
        DB::table('bills')->insert(['user_id' => 1,'amount_pending' => 11000,'total_amount' => 12000,
            'amount_paid' => 1000,'amount_paid_date' => '2017-10-10 00:00:00',]);
        
    }
}
