# Strupt Docs
Create and manage API documentation

## Setup
1. Download the source code or clone the repository (git clone)
2. Include the __docs__ directory in your project
3. Edit the __docs/config.json__ files to modify the documentation content
3. Load the __docs/index.php__ file to generate and view your API documentation

## Documentation style
You would need to modify the __docs/config.json__ file whenever you want to update your API documentation. Below is a list of valid parameters

__application__: The application name e.g. Strupt<br/>
__color__: The base color used in the header and selected category links<br/>
__colorLight__: The light color used when hovering over category links<br/>
__year__: The year your company/business started (Used only in the documentation footer)<br/>
__content__: The API documentation content

## Documentation content
Below is a list of valid parameters used to generate the documentation content

__description__: A short description of the API<br/>
__type__: The HTTP Method type used e.g. GET or POST<br/>
__endpoint__: The API endpoint used e.g. https://www.strupt.xyz/api/test.php<br/>
__success__: An example of a successful response (HTML characters for formatting is allowed)<br/>
__error__: An example of a failed response (HTML characters for formatting is allowed)<br/>
__params__: A list of the required/optional parameters and a short description of each<br/>
__codes__: A list of the possible error codes returned and a short description of each<br/>

## Example
Check out the included __config.json__ file for a valid example of acceptable parameters and formatting

## Contact Us
1. Visit our website - [https://www.strupt.xyz](https://www.strupt.xyz)
2. Send us an email - [support@strupt.xyz](mailto:support@strupt.xyz)
3. Like us on [Facebook](http://facebook.com/StruptOfficial)
4. Follow us on [Twitter](https://twitter.com/StruptOfficial0)