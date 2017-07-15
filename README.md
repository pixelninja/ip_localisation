FreeGeoIP Service
=================

Returns a users geo location information based off the awesome [freegeoip.net](http://www.freegeoip.net) API for Symphony CMS

This extension is heavily based on Dom Sammut's extension FreeGeoIP Service:

 - [FreeGeoIP Service](https://github.com/domsammut/freegeoip_service)


## Example Output

An example of the data set returned in your page XML:

    <ip-localisation>
         <Ip>8.8.8.4</Ip>
         <CountryCode>US</CountryCode>
         <CountryName>United States</CountryName>
         <RegionCode>CA</RegionCode>
         <RegionName>California</RegionName>
         <City>Mountain View</City>
         <ZipCode>94043</ZipCode>
         <Latitude>37.4192</Latitude>
         <Longitude>-122.0574</Longitude>
         <MetroCode>807</MetroCode>
         <AreaCode>650</AreaCode>
    </ip-localisation>

### Usage

There is a request limit of 10,000 per hour.

Alternatively you can download the source code for freegeoip.net off GitHub and run your own server and simply update the `$location` variable in the class.freegeoip_service.php file.

## Installation

Follow instructions the on [how to install a Symphony extension](http://www.getsymphony.com/learn/tasks/view/install-an-extension/).

## Adding it to your site

1. Navigate to Pages and edit the page you wish to have IP Localisation information
2. Add the `IP Localisation` Data Source
3. Finished! You'll now see the nodeset in the Page XML.

## Overriding the user's IP location

Sometimes we want to override the user's location. There is a URL parameter, `?set_country_code=XX`, that updates the `/data/param/country` value. This allows you to have a country select box, with preset options.

To clear the country code, and go back to the user's location, use the URL parameter `?clear_country_code`
