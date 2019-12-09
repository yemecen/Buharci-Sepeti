<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Ixudra\Curl\Facades\Curl;
use App\group;
use App\groupssale;

class PagesController extends Controller
{
    public function getIndex()
    {
        return view('pages.accesstoken');
    }

    public function saveAccestoken(Request $request)
    {
        $accesstoken=$request->accessToken;
		Session::set('success', $accesstoken);
    	

        return view('pages.accesstoken');
    }

    public function getGroupListsIndex()
    {
    		$accesstoken=Session::get('success');

    	    $grouplists = Curl::to('https://graph.facebook.com/v2.3/me/?fields=groups&limit=100&access_token='.$accesstoken)
          	->get();

            $resultarray=json_decode($grouplists,true);
            
            foreach ($resultarray['groups']['data'] as $value) {
               
               $count=group::where('id',floatval($value['id']))->count();

               if ($count==0) {
                   $group=new group;
                   $group->id = floatval($value['id']);
                   $group->name = $value['name'];
                   $group->save();
               }              

            }
            
            $groups=group::all();
            return view('pages.grouplists')->withGroups($groups);   	
           
    }
    public function getGroupSalesIndex(Request $request)
    {
    	$selected_group_ids=$request->selected_group_ids;
    	$accesstoken=Session::get('success');

    	foreach ($selected_group_ids as $group_id) {

    		$url="https://graph.facebook.com/v2.3/".$group_id."/feed?date_format=Y-m-d&fields=id,full_picture,permalink_url,created_time,message&limit=100&access_token=".$accesstoken;

    		$selectedGroupSales = Curl::to($url)
          	->get();

            $sales=json_decode($selectedGroupSales,true);
           
            foreach ($sales["data"] as $value) {

                    $count=groupssale::where('id','like','%'.$value['id'].'%')->count();

                   if ($count==0) {
                        
                    $groupssale=new groupssale;
                    $groupssale->id=$value['id'];
                    $groupssale->fullPicture=isset($value['full_picture']) == true ? $value['full_picture'] : "-";
                    $groupssale->permalinkUrl=isset($value['permalink_url']) == true ? $value['permalink_url'] : "-";
                    $groupssale->salesCreatedTime=isset($value['created_time']) == true ? $value['created_time'] : "-";
                    $groupssale->message=isset($value['message']) == true ? $value['message'] : "-";
                    $groupssale->salesUpdatedTime=isset($value['updated_time']) == true ? $value['updated_time'] : "-";
                    $groupssale->groupId=$group_id;
                    $groupssale->save();   
                    
                    }        
            }
            
    	}
            return "Aktarım Başarılı"; 

    }
    public function getVapeSalesIndex()
    {
        $sales=groupssale::where('fullPicture','not like','-')
        ->orderBy('salesCreatedTime','desc')
        ->paginate(20);
        return view('pages.vapesales')->withSales($sales);
    }

    public function getVapeSalesSearch(Request $request)
    {
        $search=$request->search;

        $split=explode("#",$search);

        if (isset($split[0]) && isset($split[1])) {
            $equipment=trim($split[0]);
            $city=trim($split[1]);
            $mark=true;

            $sales=groupssale::where('message','like','%'.$equipment.'%')
                    ->where('message','like','%'.$city.'%')
                    ->where('fullPicture','not like','-')
                    ->orderBy('salesCreatedTime','desc')
                    ->get();

             return view('pages.vapesalessearch')->withSales($sales)->withEquipment($equipment)->withCity($city)->withMark($mark);
        }
        else{
            $equipment=trim($split[0]);
            $mark=true;

            $sales=groupssale::where('message','like','%'.$equipment.'%')
                    ->where('fullPicture','not like','-')
                    ->orderBy('salesCreatedTime','desc')
                    ->get();

             return view('pages.vapesalessearch')->withSales($sales)->withEquipment($equipment)->withMark($mark);
        }
    }
}
