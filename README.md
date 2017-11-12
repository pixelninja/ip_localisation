IP Localisation
=================

Returns a users geo location information, with the ability to override based on URL parameters, for Symphony CMS from [GeoBytes](http://geobytes.com/geobytes-apis/).

## Example Output

An example of the data set returned in your page XML:

    <ip-localisation>
        <geobytesforwarderfor handle="geobytesforwarderfor" value="geobytesforwarderfor"></geobytesforwarderfor>
        <geobytesremoteip handle="geobytesremoteip" value="geobytesremoteip">127.0.0.1</geobytesremoteip>
        <geobytesipaddress handle="geobytesipaddress" value="geobytesipaddress">172.217.25.142</geobytesipaddress>
        <geobytescertainty handle="geobytescertainty" value="geobytescertainty">99</geobytescertainty>
        <geobytesinternet handle="geobytesinternet" value="geobytesinternet">AU</geobytesinternet>
        <geobytescountry handle="geobytescountry" value="geobytescountry">Australia</geobytescountry>
        <geobytesregionlocationcode handle="geobytesregionlocationcode" value="geobytesregionlocationcode">AUVI</geobytesregionlocationcode>
        <geobytesregion handle="geobytesregion" value="geobytesregion">Victoria</geobytesregion>
        <geobytescode handle="geobytescode" value="geobytescode">VI</geobytescode>
        <geobyteslocationcode handle="geobyteslocationcode" value="geobyteslocationcode">AUVIMELB</geobyteslocationcode>
        <geobytesdma handle="geobytesdma" value="geobytesdma">0</geobytesdma>
        <geobytescity handle="geobytescity" value="geobytescity">Melbourne</geobytescity>
        <geobytescityid handle="geobytescityid" value="geobytescityid">1225</geobytescityid>
        <geobytesfqcn handle="geobytesfqcn" value="geobytesfqcn">Melbourne, VI, Australia</geobytesfqcn>
        <geobyteslatitude handle="geobyteslatitude" value="geobyteslatitude">-37.817001</geobyteslatitude>
        <geobyteslongitude handle="geobyteslongitude" value="geobyteslongitude">144.966995</geobyteslongitude>
        <geobytescapital handle="geobytescapital" value="geobytescapital">Canberra</geobytescapital>
        <geobytestimezone handle="geobytestimezone" value="geobytestimezone">+10:00</geobytestimezone>
        <geobytesnationalitysingular handle="geobytesnationalitysingular" value="geobytesnationalitysingular">Australian</geobytesnationalitysingular>
        <geobytespopulation handle="geobytespopulation" value="geobytespopulation">19357594</geobytespopulation>
        <geobytesnationalityplural handle="geobytesnationalityplural" value="geobytesnationalityplural">Australians</geobytesnationalityplural>
        <geobytesmapreference handle="geobytesmapreference" value="geobytesmapreference">Oceania </geobytesmapreference>
        <geobytescurrency handle="geobytescurrency" value="geobytescurrency">Australian dollar </geobytescurrency>
        <geobytescurrencycode handle="geobytescurrencycode" value="geobytescurrencycode">AUD</geobytescurrencycode>
        <geobytestitle handle="geobytestitle" value="geobytestitle">Australia</geobytestitle>
    </ip-localisation>

### Reasonable Free Access Limits

If you expect to exceed the services “Reasonable Free Access Limit” of 16,384 accesses per hour, (about 4.5 look-ups per second), or wish to access the service via SSL, then you may wish to purchase some Mapbytes to pay for these additional look-ups, and thereby become a VIP.

## Installation

Follow instructions the on [how to install a Symphony extension](http://www.getsymphony.com/learn/tasks/view/install-an-extension/).

## Adding it to your site

1. Navigate to Pages and edit the page you wish to have IP Localisation information
2. Add the `IP Localisation` Data Source
3. Finished! You'll now see the nodeset in the Page XML.

## Overriding the user's IP location

Sometimes we want to override the user's location. There is a URL parameter, `?set_country_code=XX`, that updates the `/data/param/country` value. This allows you to have a country select box, with preset options.

To clear the country code, and go back to the user's location, use the URL parameter `?clear_country_code`
