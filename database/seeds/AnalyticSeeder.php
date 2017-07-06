<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 7/2/17
 * Time: 11:50 PM
 */
class AnalyticSeeder extends Seeder
{
    // TODO build the analytics

    public function run()
    {
        $total_records_analytic = new \App\Analytic();

        $total_records_analytic->operator_type = \App\Enums\EnumAnalyticType::getKeyByValue('Total');
        $total_records_analytic->analytic_object_type = \App\Record::class;
        $total_records_analytic->analytic_object_property = 'timeperiod->duration';

        $total_records_analytic->save();

    }
}