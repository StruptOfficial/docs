# Strupt Docs
Create and manage API documentation

## Setup
1. Download the source code or clone the repository (git clone)
2. Include the docs directory in your project
3. Edit the docs/config.json files to modify the documentation content
3. Load the docs/index.php file to generate and view your API documentation

## Documentation style
You would need to modify the docs/config.json file whenever you want to update your API documentation. Below is a list of valid parameters

_application_: The application name e.g. Strupt
_color_: The base color used in the header and selected category links
_colorLight_: The light color used when hovering over category links
_year_: The year your company/business started (Used only in the documentation footer)
_content_: The API documentation content

## Documentation content
Below is a list of valid parameters used to generate the documentation content

_description_: A short description of the API
_type_: The HTTP Method type used e.g. GET or POST
_endpoint_: The API endpoint used e.g. https://www.strupt.xyz/api/test.php
_success_: An example of a successful response (HTML characters for formatting is allowed)
_error_: An example of a failed response (HTML characters for formatting is allowed)
_params_: A list of the required/optional parameters and a short description of each
_codes_: A list of the possible error codes returned and a short description of each

## Example
Check out the included config.json file for a valid example of acceptable parameters and formatting

## Contact Us
1. Visit our website - [https://www.strupt.xyz](https://www.strupt.xyz)
2. Send us an email - [support@strupt.xyz](mailto:support@strupt.xyz)
3. Like us on [Facebook](http://facebook.com/StruptOfficial)
4. Follow us on [Twitter](https://twitter.com/StruptOfficial0)