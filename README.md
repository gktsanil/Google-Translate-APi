# Google Translate APi 

Google Translate APi is a Zend Framework App for translate any text to target language.

## Github Installation

You can clone from Github.
```bash
git clone https://github.com/gktsanil/Google-Translate-APi.git
cd Google-Translate-APi
composer install
composer serve
```
## Zip Package Installation

Extract zip to your computer and open command line in extract folder.
```bash
composer install
composer serve
```

## Docker Installation

Extract zip to your computer and open command line in extract folder.
```bash
docker build -t <IMAGE_NAME> .
docker run -p 8080:80 <IMAGE_NAME>
```
## Usage

Go to your browser and use this.
```link
http://localhost:8080 
```

## Features
 - Translate any text or word to target language.
 - Search for words or words in the target text.
 - Every user can search just 3 times.
 - Searched words if exist in the target text it bold marked.

## License
[MIT](https://choosealicense.com/licenses/mit/)