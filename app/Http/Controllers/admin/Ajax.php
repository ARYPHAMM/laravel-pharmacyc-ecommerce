<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ajax extends Controller
{
    public function process(Request $request)
    {
        $status = 0;
        $results = array();
        switch ($request->type) {
            case 'status':
                $item = DB::table($request->table)->where('id', 'like', $request->id)->get()->first();
                $item = (array)$item;
                DB::table($request->table)->where('id', $request->id) ->limit(1)->update(array(
                    $request->status => intval($item[$request->status]) == 0? '1': '0',
                ));
                $status = 1;
                break;
            case 'find':
                $results = DB::table($request->table)->where('title', 'like', '%' . $request->title . '%')->where('lang_id', 'like', $request->default_lang_id);

                $status = 1;
                break;

            default:
                $status = 0;
                break;
        }
        return response()->json(['status' => $status,'result' => $results->get()->toArray()], 200);
    }
}
