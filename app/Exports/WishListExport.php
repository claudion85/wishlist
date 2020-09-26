<?php

namespace App\Exports;

use App\WishList;
use App\User;
use App\Product;
use App\ExportCsvModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WishListExport implements FromCollection,WithHeadings
{
    protected $delimiter = ';';
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        
        $wishlist=WishList::all();
        $exportCsvCollection;
        foreach ($wishlist as $wish){
            $exportModel=new ExportCsvModel();
            $user=User::find($wish->user_id);
            $exportModel->user=$user->name;
            $exportModel->title_wishlist=$wish->wishlist_name;
            
            $arr=json_decode($wish->items);
            $exportModel->number_of_items=count($arr);
            $exportCsvCollection[]=collect($exportModel);
            /*$wish->user=$user->name;
            $exportCsv=collect($user->name);
            $wish->title_wishlits=$wish->wishlist_name;
            $arr=json_decode($wish->items);
            $wish->number_of_items=count($arr);
            //$response[]=collect($temp);*/
        }
       
        return collect($exportCsvCollection);
    }

    public function headings(): array
    {
        return [
            'user',
            'wishlist_title',
            'number_of_items'
        ];
    }
}
