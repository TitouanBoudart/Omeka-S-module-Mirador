<?php declare(strict_types=1);

namespace Mirador\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Mirador\Form\Element\OptionalSelect;

class SettingsFieldset extends Fieldset
{
    protected $label = 'Mirador Viewer'; // @translate

    /**
     * @var array
     */
    protected $plugins = [];

    public function init(): void
    {
        $this
            ->add([
                'name' => 'mirador_version',
                'type' => Element\Radio::class,
                'options' => [
                    'label' => 'Mirador version', // @translate
                    'info' => 'The two viewers use different options, so you need to change them too when the version is modified.', // @translated
                    'value_options' => [
                        '2' => '2.7', // @translate
                        '3' => '3.0 and above', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'mirador_version',
                ],
            ])
            ->add([
                'name' => 'mirador_plugins',
                'type' => OptionalSelect::class,
                'options' => [
                    'label' => 'Mirador plugins',
                    'info' => 'Read the doc. Some plugins require json options to work. Cross compatibility has not been checked, so add them one by one and only the needed ones.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#plugins',
                    'value_options' => $this->getPlugins(),
                    'empty_option' => '',
                    'use_hidden_element' => true,
                ],
                'attributes' => [
                    'id' => 'mirador_plugins',
                    'class' => 'chosen-select',
                    'multiple' => true,
                    'data-placeholder' => 'Select plugins…', // @translate
                ],
            ])

            ->add([
                'name' => 'mirador_config_item',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Mirador json config (item)', // @translate
                    'info' => 'This json object will be merged with the default one generated by the module. Placeholders: {manifestUri} and {canvasID}.', // @translate
                    'documentation' => 'https://github.com/daniel-km/omeka-s-module-mirador#usage',
                ],
                'attributes' => [
                    'id' => 'mirador_config_item',
                ],
            ])

            ->add([
                'name' => 'mirador_config_collection',
                'type' => Element\Textarea::class,
                'options' => [
                    'label' => 'Mirador json config (collection)', // @translate
                    'info' => 'Iiif collections are Omeka item sets, but may be search results too.',
                ],
                'attributes' => [
                    'id' => 'mirador_config_collection',
                ],
            ])

            ->add([
                'name' => 'mirador_preselected_items',
                'type' => Element\Number::class,
                'options' => [
                    'label' => 'Preselect manifests from the same collection', // @translate
                    'info' => 'Set a number of items to preselect. IiifServer should be enabled.', // @translate
                ],
                'attributes' => [
                    'id' => 'mirador_preselected_items',
                    'min' => 0,
                    'max' => 999,
                ],
            ])
        ;
    }

    /**
     * @param array $plugins
     */
    public function setPlugins(array $plugins)
    {
        $this->plugins = $plugins;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
}