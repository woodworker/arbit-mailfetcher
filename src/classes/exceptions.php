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
 * Basic arbit mailfetcher module exception
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitModuleMailfetcherException extends arbitException
{
}

/**
 * Exception will be thrown when no account name is given
 *
 * @package Mailfetcher
 * @version $Revision: $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitModuleMailfetcherNoAccountGivenException extends arbitModuleMailfetcherException
{
}