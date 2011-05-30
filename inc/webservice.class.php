<?php

/*
   ----------------------------------------------------------------------
   Monitoring plugin for GLPI
   Copyright (C) 2010-2011 by the GLPI plugin monitoring Team.

   https://forge.indepnet.net/projects/monitoring/
   ----------------------------------------------------------------------

   LICENSE

   This file is part of Monitoring plugin for GLPI.

   Monitoring plugin for GLPI is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 2 of the License, or
   any later version.

   Monitoring plugin for GLPI is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Monitoring plugin for GLPI.  If not, see <http://www.gnu.org/licenses/>.

   ------------------------------------------------------------------------
   Original Author of file: David DURIEUX
   Co-authors of file:
   Purpose of file:
   ----------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
	die("Sorry. You can't access directly to this file");
}

class PluginMonitoringWebservice {


   /**
   * Method for import XML by webservice
   *
   * @param $params array ID of the agent
   * @param $protocol value the communication protocol used
   *
   *@return array or error value
   *
   **/
   static function methodTest($params, $protocol) {
      global $LANG, $CFG_GLPI;

      if (isset ($params['help'])) {
         return array('base64'  => 'string,mandatory',
                      'help'    => 'bool,optional');
      }
      if (!isset ($_SESSION['glpiID'])) {
         return PluginWebservicesMethodCommon::Error($protocol, WEBSERVICES_ERROR_NOTAUTHENTICATED);
      }

      print_r($params);
//      $content = base64_decode($params['base64']);

      

//      $PluginFusinvinventoryImportXML = new PluginFusinvinventoryImportXML();
//      $PluginFusinvinventoryImportXML->importXMLContent($content);

//      $msg = $LANG['plugin_fusinvinventory']['importxml'][1];
//      return PluginWebservicesMethodCommon::Error($protocol, WEBSERVICES_ERROR_FAILED, '', $msg);
   }

   
   static function methodShinken($params, $protocol) {
      global $LANG, $CFG_GLPI;

      if (isset ($params['help'])) {
         return array('file'  => 'config filename to get : commands.cfg, hosts.cfg',
                      'help'    => 'bool,optional');
      }

      $pluginMonitoringShinken = new PluginMonitoringShinken();
      switch ($params['file']) {

         case 'commands.cfg':
            $array = $pluginMonitoringShinken->generateCommandsCfg();
            return array($array[0]=>$array[1]);
            break;

         case 'hosts.cfg':
            $array = $pluginMonitoringShinken->generateHostsCfg();
            return array($array[0]=>$array[1]);
            break;

         case 'contacts.cfg':
            $array = $pluginMonitoringShinken->generateContactsCfg();
            return array($array[0]=>$array[1]);
            break;

         case 'timeperiods.cfg':
            $array = $pluginMonitoringShinken->generateTimeperiodsCfg();
            return array($array[0]=>$array[1]);
            break;

         case 'all':
            $output = array();
            $array = $pluginMonitoringShinken->generateCommandsCfg();
            $output[$array[0]] = $array[1];
            $array = $pluginMonitoringShinken->generateHostsCfg();
            $output[$array[0]] = $array[1];
            $array = $pluginMonitoringShinken->generateContactsCfg();
            $output[$array[0]] = $array[1];
            $array = $pluginMonitoringShinken->generateTimeperiodsCfg();
            $output[$array[0]] = $array[1];

            return $output;
            break;

      }
   }

}

?>