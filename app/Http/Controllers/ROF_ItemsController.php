<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ROF_ItemsController extends Controller
{
    //
    public function linkRefNoBuilder($category, &$labelCount){
        
        $categoryA = "High Loss Aging Cable Protection Others (Network Improvement)";
        $categoryB = "ISP Enterprise Others (New Link)";
        $categoryC = "BHP Local Authority Others (Relocation)";
        $label = ''; 
        $linkRefNo = '';

        if (str_contains($categoryA, $category)){
            $label = "A-";
            $labelCount[0]++;
            $linkRefNo = $label . str_pad($labelCount[0], 3, "0", STR_PAD_LEFT);
            return $linkRefNo;
        }
        elseif (str_contains($categoryB, $category)){
            $label = "B-";
            $labelCount[1]++;
            $linkRefNo = $label . str_pad($labelCount[1], 3, "0", STR_PAD_LEFT);
            return $linkRefNo;
        }
        elseif(str_contains($categoryC, $category)){
            $label = "C-";
            $labelCount[2]++;
            $linkRefNo = $label . str_pad($labelCount[2], 3, "0", STR_PAD_LEFT);
            return $linkRefNo;
        }
        else {
            return "N/A";
        }
    }
}