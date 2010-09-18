<?php
/**
 * arbit mailfetcher module fetch command
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
 * Arbit mailfetcher module fetch command
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitModuleMailfetcherPipeSet implements ezcMailParserSet
{
    protected $handle;

    public function  __construct()
    {
        $this->handle = fopen("php://stdin",'r');
    }

    public function  getNextLine() {
        if( $this->hasData() )
            return fgets($this->handle)."\n";
        else
            return null;
    }

    public function  hasData() {
        return !feof($this->handle);
    }

    public function  nextMail() {
        return false;
    }
}