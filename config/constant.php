<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Constants used In Smaart Card Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the constants.
    |
    */
    'ROLES' => [
      'superadmin'    => 'SUPER ADMIN',
      'admin'         => 'ADMIN',
      'customer'      => 'CUSTOMER',
    ],

    'STATUS' => [
      'INACTIVE'  => 0,
      'ACTIVE'    => 1,
      'DELETED'   => 2,
    ],
    'PROTECTION_STATUS' => [
      'YES'  => 1,
      'NO'   => 2,
    ],
    'STATUS_DETAILS' => [
      0 => 'IN-ACTIVE',
      1 => 'ACTIVE',
      2 => 'DELETED',
    ],
    'DATE_FILTER' => [
      'DAILY'     => 'DAILY',
      'MONTHLY'   => 'MONTHLY',
      'YEARLY'    => 'YEARLY',
    ],
    'TIME_FILTER' => [
      'HOURLY'    => 'HOURLY',
      'DAILY'     => 'DAILY',
      'MONTHLY'   => 'MONTHLY',
      'YEARLY'    => 'YEARLY',
    ],
    'TEST_PARAMETER' => "Absolute Viscosity,Benkelman Beam Deflection Test,Bitumen Content / Binder Content Test,Bridge Load Test (Bituminous And Concrete Section),Bulk Density,Carbonation Test,CBR test,Clay Lumps,Coagulation of Emulsion @ Low Temperature,Compressive Strength,Compressive Strength Test,Cover Meter Test,Crushing Value,Determination Of Coating Ability & Water Resistance,Determination Of Mixing With Cement,Diameter & spacing of bars by Ferro scanner,Dimension,Dimensions,Direct Shear Test- C value,Direct Shear Test- phi value,Ductility,Earth Resistivity,Elongation Index,Field Density (By Core Cutter Method),Field Density (By Sand Replacement Method),Flakiness Index,Flash Point,Flexural strength,Flexural Strength,Free Swelling Index,Grain Size Analysis (Wet Sieving by Hydrometer Analysis),Grain Size Analysis( Dry Sieving ),Half cell Potential test,Light Weight Pieces,Liquid limit,Load Capacity of Pile,Marshal Stability & Flow,Maximum Dry Density (Heavy Compaction),Maximum Dry Density (Light Compaction),Mineral Matter (Ash),Miscibility With Water,Moisture Content,Optimum Moisture Content (Heavy Compaction),Optimum Moisture Content (Light Compaction ),Organic Impurities,Particle Finer Than 75 Microns,Penetration,Permeability Of Soil,Permeability test,Plastic limit,Plate Load Test,Residue By Evaporation,Residue On 600 Micron Sieve,Shrinkage Limit,Sieve Analysis,Softening Point,Solubility In Trichloroethylene,Soundness,Specific Gravity,Standard Penetration Test (Soil Investigation Test),Storage Stability After 24 hour,Surface Evenness Of Highway Pavements (Bituminous And Concrete Road)/NSV,Ultrasonic Pulse Velocity Test (UPV),Unconfined Compressive Strength Test,Viscosity By Sayblot Furol Viscometer,Water Absorption,Water Content",
    'SKU_TAGS' => [
      'Apl (Airport Parking Luton)'       => 'apl',
      'Atp (Airport Tavern Parking)'      => 'atp',
      'Gpm (Global Parking Management)'   => 'gpm',
      'Maple (Maple Manner)'              => 'maple',
      'Oakwood (Oakwood Airport Parking)' => 'oakwood'
    ],
    'PRICE_PLAN' => [
      'standard' => 'Standard Price Plan',
      'advance' => 'Advance Price Plan'
    ],
    'CLOSE_COMPANY_STATUS' => [
      'unactive' => 0,
      'active' => 1      
    ],
    'TIME_INTERVAL' => [
      '00:00', '00:15', '00:30', '00:45',
      '01:00', '01:15', '01:30', '01:45',
      '02:00', '02:15', '02:30', '02:45',
      '03:00', '03:15', '03:30', '03:45',
      '04:00', '04:15', '04:30', '04:45',
      '05:00', '05:15', '05:30', '05:45',
      '06:00', '06:15', '06:30', '06:45',
      '07:00', '07:15', '07:30', '07:45',
      '08:00', '08:15', '08:30', '08:45',
      '09:00', '09:15', '09:30', '09:45',
      '10:00', '10:15', '10:30', '10:45',
      '11:00', '11:15', '11:30', '11:45',
      '12:00', '12:15', '12:30', '12:45',
      '13:00', '13:15', '13:30', '13:45',
      '14:00', '14:15', '14:30', '14:45',
      '15:00', '15:15', '15:30', '15:45',
      '16:00', '16:15', '16:30', '16:45',
      '17:00', '17:15', '17:30', '17:45',
      '18:00', '18:15', '18:30', '18:45',
      '19:00', '19:15', '19:30', '19:45',
      '20:00', '20:15', '20:30', '20:45',
      '21:00', '21:15', '21:30', '21:45',
      '22:00', '22:15', '22:30', '22:45',
      '23:00', '23:15', '23:30', '23:45',
    ],
    'BOOKING' => [
      'CANCELLATION_CHARGE' => '2.00',
      'SMS_CONFIRMATION' => '.99',
    ],
    'BOOKING_STATUS' => [
      'ACTIVE' => 1,
      'TRASHED' => 2,
      'CANCEL' => 3
    ],
    'PAYMENT_METHODS' => ['Paypal', 'Stripe', 'Stripe 3DS', 'WorldPay', 'Online Payment', 'Cash', 'Phone'],
    'DEFAULT_OPERATION_TIME' => [
      'START' => '09:00',
      'END' => '19:00'
    ],
    'COMPANY_OPERATION_TYPE'=>[
      'twenty_four_into_seven' => 1,
      'flexible' => 2
    ],
    'GET_IMAGE' => url('/')."/storage/",


];
