<?php
add_action( 'customize_register', 'finkom_helper_functions_register_site_settings' );

// Add fields site identity section and new footer section in customizer
function finkom_helper_functions_register_site_settings( $wp_customize ) {



	// Store Address
	$wp_customize->add_setting(
		'woocommerce_store_address',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'option'

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'woocommerce_store_address',
			array(
				'label'          => __( 'Address', 'finkom_helper_functions' ),
				'section'        => 'title_tagline',
				'settings'       => 'woocommerce_store_address',
				'priority'       => 71
			)
			)
		);

		$wp_customize->add_setting(
			'woocommerce_store_address_2',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'option'

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woocommerce_store_address_2',
				array(
					'label'          => __( 'Address2', 'finkom_helper_functions' ),
					'section'        => 'title_tagline',
					'settings'       => 'woocommerce_store_address_2',
					'priority'       => 72
				)
				)
			);

		// Store Zip Code
		$wp_customize->add_setting(
			'woocommerce_store_postcode',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'option'

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woocommerce_store_postcode',
				array(
					'label'          => __( 'Zip', 'finkom_helper_functions' ),
					'section'        => 'title_tagline',
					'settings'       => 'woocommerce_store_postcode',
					'priority'       => 73
				)
				)
			);

			// Store City
			$wp_customize->add_setting(
				'woocommerce_store_city',
				array(
					'default'     => '',
					'sanitize_callback' => 'sanitize_text_field',
					'type'              => 'option'

				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'woocommerce_store_city',
					array(
						'label'          => __( 'City', 'finkom_helper_functions' ),
						'section'        => 'title_tagline',
						'settings'       => 'woocommerce_store_city',
						'priority'       => 74
					)
					)
				);

				// Store Country
				$wp_customize->add_setting(
					'woocommerce_store_country',
					array(
						'default'     => '',
						'sanitize_callback' => 'sanitize_text_field',
						'type'              => 'option'

					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						'woocommerce_store_country',
						array(
							'label'          => __( 'Country', 'finkom_helper_functions' ),
							'section'        => 'title_tagline',
							'settings'       => 'woocommerce_store_country',
							'priority'       => 75
						)
						)
					);

					// Store Phone
					$wp_customize->add_setting(
						'woocommerce_store_phone',
						array(
							'default'     => '',
							'sanitize_callback' => 'sanitize_text_field',
							'type'              => 'option'

						)
					);

					$wp_customize->add_control(
						new WP_Customize_Control(
							$wp_customize,
							'woocommerce_store_phone',
							array(
								'label'          => __( 'Phone', 'finkom_helper_functions' ),
								'section'        => 'title_tagline',
								'settings'       => 'woocommerce_store_phone',
								'priority'       => 76
							)
							)
						);
						// Store Email
						$wp_customize->add_setting(
							'woocommerce_store_email',
							array(
								'default'     => '',
								'sanitize_callback' => 'sanitize_email',
								'type'              => 'option'
							)
						);

						$wp_customize->add_control(
							new WP_Customize_Control(
								$wp_customize,
								'woocommerce_store_email',
								array(
									'label'          => __( 'E-mail', 'finkom_helper_functions' ),
									'section'        => 'title_tagline',
									'settings'       => 'woocommerce_store_email',
									'priority'       => 77
								)
								)
							);
						}
