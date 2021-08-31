<?php

function CheckPageAccess($UserID, $ModuleName, $param){
    $CheckPageAccess=0;

    $Access = \App\MenuAccess::Where('UserID', '=', $UserID)
            ->where('ModuleName', '=', $ModuleName)
            ->Select('view', 'add', 'edit', 'del', 'verify', 'approve')
            ->first();
    if ($Access){
        if ($param=='view'){
            $CheckPageAccess=$Access->view;
        }else if ($param=='add'){
            $CheckPageAccess=$Access->add;
        }else if ($param=='edit'){
            $CheckPageAccess=$Access->edit;
        }else if ($param=='del'){
            $CheckPageAccess=$Access->del;
        }else if ($param=='verify'){
            $CheckPageAccess=$Access->verify;
        }else if ($param=='approve'){
            $CheckPageAccess=$Access->approve;
        }
    }
    return($CheckPageAccess);
}


function GetAdminPageAccess($UserID, $ModuleName, $param){
    $pageAccess=0;
    foreach ($ModuleName as $value) {
        $pageAccess = CheckPageAccess($UserID, $value, $param);
        if ($pageAccess==1){
            break;
        }
    }
    return($pageAccess);
}


function SetFormatDate($dateInput, $param){
    $dateResult='';
    //if (DateTime::createFromFormat('Y-m-d', $dateInput) !== FALSE || DateTime::createFromFormat('Y-m-d H:i:s', $dateInput) !== FALSE) {
        $date=date_create($dateInput);
        if ($param==1){
            $format="m/d/Y";
        }else if($param==2){
            $format="m/d/Y H:i:s";
        }else if($param==3){
            $format="Y-m-d";
        }else if($param==4){
            $format="m/d/Y H:i";
        }
        $dateResult=date_format($date,$format);
    //}
    
    return $dateResult;
}


function IsNullOrEmptyString($str, $typedata){
    if (!isset($str) || trim($str) === ''){
        if ($typedata=='string'){
            $strRet ="";
        }else{
            $strRet=0;
        }
        
    }else{
        $strRet = $str;
    }
    return $strRet;
}

function getDateDiff($date1, $date2, $param){
    $diff = (strtotime($date1) - strtotime($date2));

    $days = floor($diff / (60*60*24));
    $months = floor($diff / (30*60*60*24));
    $years = floor($diff / (365*60*60*24));
    
    if ($param==1){
        $valueResult=$years;
    }else if ($param==2){
        $valueResult=$months;
    }else if ($param==3){
        $valueResult=$diff;
    }

    return $valueResult;
}