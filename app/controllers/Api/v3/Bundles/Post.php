<?php

namespace DS\Controller\Api\v3\Bundles;

use DS\Controller\Api\ActionHandler;
use DS\Controller\Api\MethodInterface;
use DS\Controller\Api\Meta\Record;
use DS\Model\DataSource\UserRoles;
use DS\Model\Bundles;
use DS\Exceptions\InvalidParameterException;

/**
 *
 * Spreadshare
 *
 * @author            Vladislav Klimenko
 * @license           proprietary
 * @copyright         Spreadshare
 * @link              https://www.spreadshare.co
 *
 * @version           $Version$
 * @package           DS\Controller
 *
 */
class Post extends ActionHandler implements MethodInterface
{
    use BundleModifier;

    /**
     * @return bool
     */
    public function needsLogin()
    {
        return true;
    }

    /**
     * @return \DS\Controller\Api\Meta\Record
     * @throws InvalidParameterException
     */
    public function process()
    {
        if (!$this->getServiceManager()->getAuth()->hasRole(UserRoles::Admin)) {
            throw new InvalidParameterException('Not allowed');
        }

        $bundleId = $this->id;
        $bundleParams = json_decode($this->extractBody(true), true);

        // Create new or Update existing bundle
        $bundle = $bundleId ? Bundles::findFirstById($bundleId) : new Bundles();
        if (!$bundle) {
            throw new InvalidParameterException('The bundle that you want to update does not exist.');
        }

        $bundle = $this->updateBundle($bundle, $bundleParams);
        return new Record($bundle->toArray(['id','title', 'image', 'tags']));
    }
}
