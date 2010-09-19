<?php
/**
 * CLI tool class for administrative tasks
 *
 * This file is part of arbit.
 *
 * arbit is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License.
 *
 * arbit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with arbit; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */

/**
 * CLI tool class, which handles various adimistrative tasks.
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitModuleMailfetcherAdminCliTool extends arbitFrameworkActionCliTool
{
    /**
     * Name of CLI tool
     *
     * @var string
     */
    protected $name = 'Arbit mailfetcher module management';

    /**
     * Short description of the purpose of the current CLI tool
     *
     * @var string
     */
    protected $description = "Arbit mailfetcher module management script.\n\nThe available actions are:";

    /**
     * Available actions.
     *
     * Mapping of the CLI action identifiers to their action names
     *
     * @var array
     */
    protected $actions = array(
        'fetch' => array(
            'action'      => 'fetch',
            'description' => 'Fetch the mails from all defined mailaccounts.',
        ),
        'inject' => array(
            'action'      => 'inject',
            'description' => 'Inject a mail to the system.',
        )
    );

    /**
     * register a cli options
     *
     * at the moment only needed for the inject action
     */
    protected function  registerOptions()
    {
        $this->in->registerOption( new ezcConsoleOption(
            'a', 'account',
            ezcConsoleInput::TYPE_STRING, null, false,
            'Account name for the injected mail'
        ) );

        parent::registerOptions();
    }

    /**
     * Get controller
     *
     * Return controller to execute for the current command
     *
     * @param arbitRequest $request
     * @param array $options
     * @return arbitController
     */
    protected function createController( arbitRequest $request, array $options )
    {
        // Find name of mailfetcher module
        $config = arbitBackendIniConfigurationManager::getProjectConfiguration(
            $request->controller
        );

        $action             = $this->in->argumentDefinition['action']->value;
        $request->action    = arbitProjectController::normalizeModuleName(
            array_search( "mailfetcher", $config->modules )
        );
        $request->subaction = $action;

        $options = $this->getOptions();

        if( $options['account']==false )
        {
            throw new arbitModuleMailfetcherNoAccountGivenException('You need to name an account', array());
        }

        $set = new arbitModuleMailfetcherPipeSet();

        $p = new ezcMailParser();
        $mails = $p->parseMail($set);

        $request->variables['account'] = $options['account'];
        $request->variables['mails'] = $mails;

        return new arbitModuleMailfetcherController( $this->actions[$action]['action'], $request );
    }
}
