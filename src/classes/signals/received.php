<?php
/**
 * arbit signal struct
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
 * Mailfetcher module received signal struct
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitMailfetcherReceivedStruct extends arbitSignalSlotStruct implements arbitUnviewableSignalSlotStruct
{
    /**
     * Array containing the structs properties.
     *
     * @var array
     */
    protected $properties = array(
        'account'   => null,
        'mail'      => null,
        'ts'        => null,
    );

    /**
     * Construct signal struct from its major data fields.
     *
     * @param string $account
     * @param ezcMail $mail
     * @param DateTime $ts
     * @return void
     */
    public function __construct( $account = null, ezcMail $mail = null , DateTime $ts = null)
    {
        $this->account  = $account;
        $this->mail     = $mail;
        $this->ts       = $ts;
    }
}