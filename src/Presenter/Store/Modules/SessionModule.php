<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

namespace PrestaShop\Module\PrestashopCheckout\Presenter\Store\Modules;

use PrestaShop\Module\PrestashopCheckout\Presenter\PresenterInterface;
use PrestaShop\Module\PrestashopCheckout\Session\Onboarding\OnboardingSessionManager;

/**
 * Construct the session module
 */
class SessionModule implements PresenterInterface
{
    /**
     * @var \Context
     */
    private $context;

    /**
     * @var \PrestaShop\Module\PrestashopCheckout\Session\Onboarding\OnboardingSessionManager
     */
    private $onboardingSessionManager;

    /**
     * @param \PrestaShop\Module\PrestashopCheckout\Session\Onboarding\OnboardingSessionManager $onboardingSessionManager
     */
    public function __construct(OnboardingSessionManager $onboardingSessionManager)
    {
        $this->context = \Context::getContext();
        $this->onboardingSessionManager = $onboardingSessionManager;
    }

    /**
     * Present the session module (vuex)
     *
     * @return array
     */
    public function present()
    {
        return [
            'session' => [
                'onboarding' => $this->onboardingSessionManager->startOnboarding()->toArray(),
            ],
        ];
    }
}
