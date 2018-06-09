<?php
# GNU LESSER GENERAL PUBLIC LICENSE
# Version 3, 29 June 2007
#
# Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
# Everyone is permitted to copy and distribute verbatim copies
# of this license document, but changing it is not allowed.
# WHYNOGROUP - WNG - WNL - WNA - WNH - WNR - WNC
# 2018-06-09 - https://api.whyno.group
/**
 * Utility to simplify the use of jquery with api v3 whynogroup
 *
 */

  /**
   * Include init.php
   */
  require ('init.php');

  /**
   * Contains the path of the temp folder
   *
   * @var path
   */
  $temp_folder = '/temp/';

  /**
   * If a file is sent from the ajax query, we move it from the PHP
   * temporary folder to the temporary folder of our wrapper.
   */
  if(!empty($_FILES['userfile']))
  {

  	$name = basename($_FILES["userfile"]["name"]);
  	move_uploaded_file(
      $_FILES["userfile"]["tmp_name"],
      getcwd().$temp_folder.'/'.$name
    );

  }

  /**
   * We convert input json data from ajax query to PHP array
   */
  $_POST['userdata'] = json_decode($_POST['userdata']);


  /**
   * While sending the request to Api, we return to Ajax a Json format
   */
  switch ($_POST['METHOD'])
  {
    /**
     * Request for GET method
     */
    case 'GET':
      echo json_encode(
        $wng->get(
          $_POST['PATH'],
          $_POST['userdata']
        )
      );
    break;

    /**
     * Request for POST method
     */
    case 'POST':
      echo json_encode(
        $wng->post(
          '/api/beta',
          $_POST['userdata'],
          $n
        )
      );
    break;

    /**
     * Request for DELETE method
     */
    case 'DELETE':
      echo json_encode(
        $wng->delete(
          $_POST['PATH'],
          $_POST['userdata']
        )
      );
    break;

    /**
     * Request for PUT method
     */
    case 'PUT':
      echo json_encode(
        $wng->put(
          $_POST['PATH'],
          $_POST['userdata'],
          $n
        )
      );
    break;
  }
