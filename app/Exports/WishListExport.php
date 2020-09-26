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
    /*set the semicolon delimiter */
    protected $delimiter = ';'; 
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        
        $wishlist=WishList::all();
        $exportCsvCollection;

        /* foreach wishlist retreive the basic informations to build the csv file */
        /* create a new model with this informations and store the object in an array*/
        
        foreach ($wishlist as $wish){
            $exportModel=new ExportCsvModel();
            $user=User::find($wish->user_id);
            $exportModel->user=$user->name;
            $exportModel->title_wishlist=$wish->wishlist_name;
            
            /* for count the number of products decode the item json in wishlist and count the length*/
            $arr=json_decode($wish->items);
            $exportModel->number_of_items=count($arr);
            $exportCsvCollection[]=collect($exportModel);
            
        }
       
        /*return a collection response */
        return collect($exportCsvCollection);
    }


    /* this function add the headings in csv file */
    public function headings(): array
    {
        return [
            'user',
            'wishlist_title',
            'number_of_items'
        ];
    }
}
