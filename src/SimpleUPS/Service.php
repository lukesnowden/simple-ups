<?php namespace SimpleUPS;

/**
 * The type of service a shipment was shipped with
 * @since 1.0
 */
class Service extends Model
{

    const
        NEXT_DAY_AIR_EARLY_AM = '14',
        NEXT_DAY_AIR = '01',
        NEXT_DAY_AIR_SAVER = '13',
        SECOND_DAY_AIR_AM = '59',
        SECOND_DAY_AIR = '02',
        THREE_DAY_SELECT = '12',
        GROUND = '03',

        INT_STANDARD = '11',
        INT_WORLDWIDE_EXPRESS = '07',
        INT_WORLDWIDE_EXPRESS_PLUS = '54',
        INT_WORLDWIDE_EXPEDITED = '08',
        INT_SAVER = '65',

        POLAND_TODAY_STANDARD = '82',
        POLAND_TODAY_DEDICATED_COURIER = '83',
        POLAND_TODAY_INTERCITY = '84',
        POLAND_TODAY_EXPRESS = '85',
        POLAND_TODAY_EXPRESS_SAVER = '86',
        POLAND_WORLDWIDE_EXPRESS_FREIGHT = '96';

    private
        /* @var string $code */
        $code,

        /* @var string $description */
        $description,

        $descriptions = array(
        // '14' => 'Next Day Air Early AM',
        // '01' => 'Next Day Air',
        // '13' => 'Next Day Air Saver',
        // '59' => 'Second Day Air AM',
        // '02' => 'Second Day Air',
        // '12' => 'Three Day Select',
        // '03' => 'Ground',
        // '11' => 'International Standard',
        // '07' => 'International Worldwide Express',
        // '54' => 'International Worldwide Express Plus',
        // '08' => 'International Worldwide Expedited',
        // '65' => 'International Saver',
        // '82' => 'Poland Today Standard',
        // '83' => 'Poland Today Dedicated Courier',
        // '84' => 'Poland Today Intercity',
        // '85' => 'Poland Today Express',
        // '86' => 'Poland Today Express Saver',
        // '96' => 'Poland Worldwide Express Freight'
        '01'    => 'UPS Next Day Air', 
        '02'    => 'UPS 2nd Day Air', 
        '03'    => 'UPS Ground',
        '07'    => 'UPS Worldwide Express',
        '08'    => 'UPS Worldwide Expedited',
        '11'    => 'UPS Standard',
        '12'    => 'UPS 3 Day Select',
        '13'    => 'UPS Next Day Air Saver',
        '14'    => 'UPS Next Day Air Early A.M.',
        '54'    => 'UPS Worldwide Express Plus',
        '59'    => 'UPS 2nd Day Air A.M.',
        '65'    => 'UPS Saver',
        ## 82-86 are Polish Domestic Shipments
        '82'    => 'UPS Today Standard',
        '83'    => 'UPS Today Dedicated Courier',
        '84'    => 'UPS Today Intercity',
        '85'    => 'UPS Today Express',
        '86'    => 'UPS Today Express Saver'
    );
    //     '01'    => 'UPS Next Day Air', Y
    // '02'    => 'UPS 2nd Day Air', 
    // '03'    => 'UPS Ground',
    // '07'    => 'UPS Worldwide Express',
    // '08'    => 'UPS Worldwide Expedited',
    // '11'    => 'UPS Standard',
    // '12'    => 'UPS 3 Day Select',
    // '13'    => 'UPS Next Day Air Saver',
    // '14'    => 'UPS Next Day Air Early A.M.',
    // '54'    => 'UPS Worldwide Express Plus',
    // '59'    => 'UPS 2nd Day Air A.M.',
    // '65'    => 'UPS Saver',
    // ## 82-86 are Polish Domestic Shipments
    // '82'    => 'UPS Today Standard',
    // '83'    => 'UPS Today Dedicated Courier',
    // '84'    => 'UPS Today Intercity',
    // '85'    => 'UPS Today Express',
    // '86'    => 'UPS Today Express Saver'

    /**
     * Set the service code
     * @internal
     *
     * @param string $code
     *
     * @return Service
     */
    public function setCode($code)
    {
        $this->code = (string)$code;

        if ($this->description === null && isset($this->descriptions[$this->code])) {
            $this->description = $this->descriptions[$this->code];
        }

        return $this;
    }

    /**
     * Get the service code
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the service description
     * @internal
     *
     * @param string $description
     *
     * @return Service
     */
    public function setDescription($description)
    {
        $this->description = (string)$description;
        return $this;
    }

    /**
     * Get the service description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get service as XML
     * @internal
     *
     * @param \DomDocument $dom
     *
     * @return \DOMElement
     */
    public function toXml(\DomDocument $dom)
    {
        $shipper = $dom->createElement('Service');

        if ($this->getCode() != null) {
            $shipper->appendChild($dom->createElement('Code', $this->getCode()));
        }

        if ($this->getDescription() != null) {
            $shipper->appendChild($dom->createElement('Description', $this->getDescription()));
        }

        return $shipper;
    }

    /**
     * Get this object from XML
     * @internal
     *
     * @param \SimpleXMLElement $xml
     *
     * @return Service
     */
    public static function fromXml(\SimpleXMLElement $xml)
    {
        $service = new Service();
        $service->setIsResponse();
        $service->setCode($xml->Code);

        if (isset($xml->Description)) {
            $service->setDescription($xml->Description);
        }

        return $service;
    }
}