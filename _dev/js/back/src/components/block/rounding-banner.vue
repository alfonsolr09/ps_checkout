<!--**
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
 *-->
<template>
  <div>
    <b-alert
      v-if="!roundingSettingsIsCorrect && !isReady"
      variant="warning"
      show
    >
      <h2>{{ $t('block.rounding-banner.title') }}</h2>
      <p class="mb-3">
        {{ $t('block.rounding-banner.content') }}
      </p>
      <p>
        <b-button
          target="_blank"
          variant="outline-secondary"
          @click="updateRoundingSettings()"
        >
          {{ $t('block.rounding-banner.button') }}
        </b-button>
      </p>
    </b-alert>
    <b-alert v-if="confirmationAlert" variant="success" show>
      <h2>{{ $t('block.rounding-banner.confirmationTitle') }}</h2>
      <p class="mb-3">
        {{ $t('block.rounding-banner.confirmationLabel') }}
      </p>
    </b-alert>
  </div>
</template>

<script>
  export default {
    name: 'RoundingBanner',
    data() {
      return {
        confirmationAlert: false
      };
    },
    methods: {
      updateRoundingSettings() {
        this.$store.dispatch('updateRoundingSettings').then(() => {
          this.confirmationAlert = true;
        });
        this.$segment.track('CKT Click Change Roundings', {
          category: 'ps_checkout'
        });
      }
    },
    computed: {
      isReady() {
        return this.$store.state.context.isReady;
      },
      roundingSettingsIsCorrect() {
        return this.$store.getters.roundingSettingsIsCorrect;
      }
    },
    watch: {
      confirmationAlert(value) {
        if (value === false) {
          return;
        }

        setTimeout(() => {
          this.confirmationAlert = false;
        }, 6000);
      }
    },
    mounted() {
      if (!this.roundingSettingsIsCorrect && !this.isReady) {
        this.$segment.track('CKT Display Banner Rounding Settings', {
          category: 'ps_checkout'
        });
      }
    }
  };
</script>
