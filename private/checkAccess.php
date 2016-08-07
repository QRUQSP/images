<?php
//
// Description
// -----------
// This function will check if the user has access to the images module for a station.
//
// Arguments
// ---------
// q:
// station_id:                  The ID of the station to check the session user against.
// method:                      The requested method.
//
// Returns
// -------
// <rsp stat='ok' />
//
function qruqsp_images_checkAccess(&$q, $station_id, $method) {
    //
    // Check if the module is enabled for the station and if the user is an operator
    //
    qruqsp_core_loadMethod($q, 'qruqsp', 'core', 'private', 'checkModuleAccess');
    $rc = qruqsp_core_hooks_checkModuleAccess($q, $station_id, array(
        'package'=>'qruqsp',
        'module'=>'images',
        'sysadmins'=>'yes',
        'groups'=>array('operators'),
        ));
    if( $rc['stat'] != 'ok' ) {
        return array('stat'=>'fail', 'err'=>array('code'=>'qruqsp.images.1', 'msg'=>'Access denied', 'err'=>$rc['err']));
    }

    //
    // The module is enabled and the user has access
    //
    return array('stat'=>'ok');
}
?>
