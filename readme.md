# TYPO3 extension in2studyfinder


## Introduction

in2studyfinder is a generic TYPO3 extension, which makes it possible to add, maintain and
display courses of studies in a structured way with different filterable views.
This extension is the basic version, which can be extended by various fields, functions and interfaces.

## Installation

Require in2studyfinder via copmoser: `composer require in2code/in2studyfinder` or download a current version from [https://github.com/in2code-de/in2studyfinder](in2studyfinder on github) or install in2studyfinder from TER or in the Extension Manager.
Include in2studyfinder's TypoScript Template "Basic Template" and "CSS Template" if you want to have a minimum of styles in the frontend (e.g. if you don't want to style it yourself).
If your TYPO3 installation does not include jQuery in the Frontend yet, you have to set the constant `plugin.tx_in2studyfinder.settings.javascript.addJQueryFromGoogle = 1` to enable jQuery inclusion (required).
Create a storage folder in your page tree where you will add your study courses and set all `settingsPids` and `storagePids` of in2studyfinder to the storage folder's UID.

### Target group

TYPO3 Websites from

* Colleges + Hochschulen
* Universities + Universitäten

### Links

* Live examples: https://www.tum.de/studium/studienangebot/ and http://www.uni-ulm.de/studium/studieren-an-der-uni-ulm/studiengaenge/
* See full description (german only) under: https://www.in2code.de/produkte/studiengangsfinder/
* Interest in an extension or interface connection: contact us <a href="mailto:sandra.pohl@in2code.de">sandra.pohl@in2code.de</a>


## Individual modules and functions

in2studyfinder can be extended by individual importers (e.g. from SLCM, Hochschulkompass, HIS, etc.).
It's also possible to extend it with new fields or additional tables or add new functions like a keyword filter.
Please ask Sandra for more information about additional modules or if you need professional services:

https://www.in2code.de/produkte/studiengangsfinder/

sandra.pohl@in2code.de


## Screenshots

<img src="https://box.everhelper.me/attachment/946138/a6805156-9507-4f6d-924c-1217f09d07c6/817759-hn4DsXYwkhTmIWBV/screen.png" width="500" />

<img src="https://box.everhelper.me/attachment/946151/a6805156-9507-4f6d-924c-1217f09d07c6/817759-N6h67qc6NZDY4FVn/screen.png" width="500" />

<img src="https://box.everhelper.me/attachment/946154/a6805156-9507-4f6d-924c-1217f09d07c6/817759-BCxwhsEX5ZWTDZX8/screen.png" width="500" />


## Requirements

* TYPO3 6.2, 7.6 or newer
* PHP 5.6 or newer


## FAQ

* Q1: Can I use fe_users or tt_address for the persons?
* A1: Of course, you can map persons to any existing table via TypoScript
* Q2: I need to import persons from an external service, but how?
* A2: Please ask in2code for professional service or individual importers


## Changelog

| Version    | Date       | State      | Description                                                                  |
| ---------- | ---------- | ---------- | ---------------------------------------------------------------------------- |
| 2.1.2      | 2017-08-30 | BUGFIX     | Use the correct repository if the extension is extended                      |
| 2.1.1      | 2017-08-29 | BUGFIX     | Use correct cmpObj function if the course model has been overwritten         |
| 2.1.0      | 2017-08-24 | FEATURE    | Add option to save selected filter values, [!!!][TASK] Drop StuyCourseListContextRepository. For more details look at the release commit 2.1.0 |
| 2.0.4      | 2017-06-28 | BUGFIX     | Always set filter, hide invalid start of study date, use cache API correctly |
| 2.0.3      | 2017-06-13 | BUGFIX     | Some small CSS fixes                                                         |
| 2.0.2      | 2017-06-12 | BUGFIX     | Fix number of requests on quickjump, change loading image with SVG           |
| 2.0.1      | 2017-06-02 | BUGFIX     | Add a readme and license file                                                |
| 2.0.0      | 2017-05-31 | Task       | Initial free release on Github                                               |