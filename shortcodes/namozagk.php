<?php

if (is_plugin_active('mnbaa_namozagk/mnbaa_namozagk.php')) {
    if (class_exists('Form')) {
        $form = \DI()->get('Form');
        $forms = $form::find_all();

        if (count($forms > 0)) {
            $ids = array();

            foreach ($forms as $form) {
                $ids[] = array(
                    'value' => $form->id,
                    'label' => $form->id
                );
            }

            return array(
                'namozagk' => array(
                    'label' => __('Namozagk Form', 'qalep'),
                    'type' => 'shortcode',
                    'shortcode_base' => 'Mnbaa Namozagk',
                    'properties' => array(
                        'Form ID' => array(
                            "label" => __('Form ID', 'qalep'),
                            "input_type" => "select",
                            "choices" => $ids
                        )
                    )
                )
            );
        }
    }
}