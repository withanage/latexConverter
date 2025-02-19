
# Latex to PDF Converter Plugin

The plugin for OJS 3.3 that allows to convert articles in Latex to PDF format.


-   [Latex to PDF Converter Plugin](#latex-to-pdf-converter-plugin)
-   [Features](#features)
    -   [Extract Archive](#extract-archive)
    -   [Convert to PDF](#convert-to-pdf)
-   [Install and configure the plugin](#install-and-configure-the-plugin)
    -   [Requirements](#requirements)
    -   [Install with Git](#install-with-git)
    -   [Install via direct download](#install-via-direct-download)
    -   [Install TexLive portable  (Linux)](#install-texlive-portable-linux)
    -   [Configuration of the plugin](#configuration-of-the-plugin)
-   [Development](#development)
    -   [Structure](#structure)
    -   [Notes](#notes)

# Features

### Extract Archive

Currently only ZIP files are supported.

This functionality is shown if there is an archive file file present in the Production phase.

Clicking this button will do the following: 
- get list of files in archive file
- present the list to the user in a modal
- the user selects which file will be the main file
- the archive file is extracted
  - the selected file will be added as the main file
  - all other files will be added as dependent files

### Convert to PDF

This functionality is shown for all files with the extension TEX in the Production phase.

Clicking this button will do the following:
- copy all files to temp file for processing
- execute pdflatex from shell
- check if there is a compiled pdf present:
  - if there is a pdf file
    - add this file the submission
    - add other output files as dependent files (aux, bcf, log, out, run.xml)
  - if there is no pdf file, than something went wrong
    - add the log file to the submission
    - add other output files as dependent files (aux, bcf, out, run.xml)

![latexConverter - extract and convert](.project/images/latexConverter-extract-convert.gif)

# Install and configure the plugin

### Requirements

- PHP 8.1+
- A LaTex converter for your platform, e.g. [TexLive](https://tug.org/texlive)

### Install with Git

```shell
git clone https://github.com/GaziYucel/latexConverter
```

### Install via direct download

- Download release for your OJS version from https://github.com/TIBHannover/latexConverter/releases
- Alternatively, download the code with the option 'Download ZIP'. 
- Extract the downloaded file to `./plugins/generic/latexConverter`.

### Install TexLive portable (Linux)

```shell
# example of installation path: /var/www/TexLive
# TexLive will be installed with all packages and options (around 8GB)
mkdir -p /var/www/TexLive/tmp
cd /var/www/TexLive/tmp
wget https://mirror.ctan.org/systems/texlive/tlnet/install-tl-unx.tar.gz
zcat < install-tl-unx.tar.gz | tar xf -
cd install-tl-*
perl install-tl --portable --no-interaction --TEXDIR /var/www/TexLive/texmf --TEXMFLOCAL /var/www/TexLive/texmf-local --TEXMFSYSCONFIG /var/www/TexLive/texmf-config --TEXMFSYSVAR /var/www/TexLive/texmf-var
export PATH=/var/www/TexLive/texmf/bin/x86_64_linux:$PATH
cd /var/www/TexLive
rm -rf tmp
```

#### Manual usage of pdflatex

```shell
cd /path-to-some-latex-project
/var/www/TexLive/texmf/bin/x86_64_linux/pdflatex -no-shell-escape -interaction=nonstopmode main.tex
```

### Configuration of the plugin

- Login in your OJS instance as an Administrator or Manager
- Navigate to Website > Plugins > Installed Plugins > Generic Plugins > LaTex to PDF Converter Plugin > Settings
- Fill in the absolute path to pdflatex executable, e.g. /var/www/TexLive/texmf/bin/x86_64-linux/pdflatex
- Fill in the field "Allowed mime types" with mime types which should show dependent files. For Tex files fill in "text/x-tex" and "application/x-tex" on separate lines
- Click Save

![latexConverter - settings](.project/images/latexConverter-settings.gif)

# Development

- Fork the repository
- Make your changes
- Open a PR with your changes

### Structure
    .
    ├── classes
    │   ├── Action                            # Features main classes
    │   │   ├── Convert.inc.php               # Convert to PDF feature main class
    │   │   └── Extract.inc.php               # Extract archive feature main class
    │   ├── Components
    │   │   └── Forms
    │   │       └── SettingsForm.inc.php      # Settings form class
    │   ├── Handler
    │   │   └── PluginHandler.inc.php         # Main plugin handler / controller
    │   ├── Models                            # Helper classes
    │   │   ├── ArticleSubmissionFile.inc.php # Add submission files to submission
    │   │   ├── Cleanup.inc.php               # Cleanup methods
    │   │   └── Log.php                       # Logging to file methods
    ├── images                                # Images used by the plugin
    ├── locale                                # Language files
    ├── templates                             # Templates folder
    │   ├── extract.tpl                       # Template for the extract modal
    │   └── settings.tpl                      # Settings template
    ├── vendor                                # Composer autoload and dependencies    
    ├── .gitignore                            # Git ignore file
    ├── composer.json                         # Composer file, e.g. dependencies, classmap
    ├── index.php                             # Main entry point of plugin
    ├── LatexConverterPlugin.inc.php          # Main class of plugin
    ├── README.md                             # This file
    └── version.xml                           # Current version of the plugin

### Notes

- Auto loading of the classes in the folder `classes` is done with composer [classmap](https://getcomposer.org/doc/04-schema.md#classmap).
- If you add or remove classes in this folder, run the following command to update the autoload files: `composer dump-autoload -o`.
- Running `composer install -o` or `composer update -o` will also generate the autoload files
- The `-o` option generates the optimised files ready for production.

...
