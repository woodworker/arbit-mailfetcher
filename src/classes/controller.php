<?php
/**
 * arbit mailfetcher base controller
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
 * Base mailfetcher controller.
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitModuleMailfetcherController extends arbitController
{
    /**
     * emit mailfetcherRecived signal to the system
     *
     * @param ezcMail $mail
     */
    protected function emitMailfetcherRecived( $mailaccount , ezcMail $mail )
    {
        arbitSignalSlot::emit(
            'mailfetcherReceived',
            new arbitMailfetcherReceivedStruct(
                $mailaccount,
                $mail,
                new DateTime()
            )
        );
    }

    /**
     * this method fetches all the mail
     *
     * @param arbitRequest $request
     * @return arbitViewModuleModel
     */
    public function fetch( arbitRequest $request )
    {
        $mail = new ezcMail();
        $this->emitMailfetcherRecived($mail);
        
        return new arbitViewModuleModel( $request->action, array(), new arbitViewUserMessageModel( 'Fetched Mails.' ) );
    }

    /**
     *
     * @param arbitRequest $request
     */
    public function inject( arbitRequest $request )
    {
        $account = $request->variables['account'];
        $mails = $request->variables['mails'];

        $i = 0;
        foreach ( $mails as $oneMail ) {
            /* @var $oneMail ezcMail */
            $this->emitMailfetcherRecived( $account , $oneMail );
            $i++;
        }

        return new arbitViewModuleModel( $request->action, array(), new arbitViewUserMessageModel( "Injected $i Mails.\n" ) );
    }
}
