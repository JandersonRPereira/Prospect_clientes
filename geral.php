<?php

    require_once('api.php');

    $api = new API();

    $act = $_REQUEST['act'];

    // print_r(json_encode($_REQUEST['data']));

    switch ($act) {
        
        // getUF
        case 'getUf':
            $res['results'] = $api->getUf();
            print $res['results'];
            break;
        
        // getCidades
        case 'getCidades':
            $res['results'] = $api->getCidades($_REQUEST['id']);
            print $res['results'];
            break;
        
        // insertPrespect
        case 'insertPrespect':
            $res['results'] = $api->insertPrespect(json_decode($_REQUEST['data']));
            print $res['results'];
            break;
        
        // getClientes
        case 'getClientes':
            $res['results'] = $api->getClientes();
            print $res['results'];
            break;
        
        // updateDados
        case 'updateDados':
            $res['results'] = $api->updateDados($_REQUEST['id']);
            print $res['results'];
            break;
        
        // alterarDados
        case 'alterarDados':
            $res['results'] = $api->alterarDados(json_decode($_REQUEST['data']));
            print $res['results'];
            break;
        
        // deleteCliente
        case 'deleteCliente':
            $res['results'] = $api->deleteCliente($_REQUEST['id']);
            print $res['results'];
            break;
       
        
        default:
            # code...
            break;
    }

    
    

?>