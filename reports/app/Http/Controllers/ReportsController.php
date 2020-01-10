<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ReportsResourceCollection;

class ReportsController extends Controller
{
    //
    public function show(Request $request, $db,$id,$table_one, $table_two = NULL) //: ReportsResourceCollection
    {
        ini_set('memory_limit','600M'); //
        $post = $request->except(['year','month']);



        $parent = DB::connection($db)->table('reports')->where('id', '=', $id)->first();
        if($parent->add_where == 'yes'){

            if(!empty($post )){
                $report = DB::connection($db)->table($table_one)->select($request->all())->where($parent->where_column??'id', $parent->operand??'=', $parent->where_value??'')->get();
                return $this->makeCollection($report);
            }

            $report = DB::connection($db)->table($table_one)->where($parent->where_column, $parent->operand, $parent->where_value)->get();
            return $this->makeCollection($report);

        }




        if(empty($post)){

            return $this->getAll($db,$table_one,$table_two);
        }
 
        $one = DB::connection($db)->table($table_one)->select($post);

        if(!isset($table_two)){

            return $this->makeCollection($one->get());
        }

        $report = DB::connection($db)->table($table_two)->select($post)->unionAll($one)->get();
        // $count = ['total' => count($report)]
        return $this->makeCollection($report);

    }

    public function getAll($db,$table_one,$table_two)
    {
        ini_set('memory_limit','600M');
        $one = DB::connection($db)->table($table_one);
        if(!isset($table_two)){

            return $this->makeCollection($one->get());
        }

        $report = DB::connection($db)->table($table_two)->unionAll($one)->get();
        $bool   = in_array($table_one, ['ap_detail','gl_detail']);
        return $this->makeCollection($report, $bool);

    }

    public function makeCollection($report, $true = null) //: ReportsResourceCollection
    {
        ini_set('memory_limit','600M');
        $array = json_decode(json_encode($report), true);

        if(isset($true)){

            foreach($array as $item){

                    $item['year']  = date('Y',strtotime ($item['sDate']??$item['Date']??''));
                    $item['month'] = date( 'm', strtotime ($item['sDate']??$item['Date']??''));
                    $new_array[] = $item;
            }

        }else{

            $new_array = $array;
        }
        // $count = json_encode(['total' => count($report)]);
        // return $count;
        return  new ReportsResourceCollection($new_array);
    }
}
