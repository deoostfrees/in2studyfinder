<?php
namespace In2code\In2studyfinder\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TcaUtility
 *
 * @package In2code\In2studyfinderExtend\Utility
 */
class TcaUtility
{
    /**
     * Gets full Tca Array for Sys Language Uid
     *
     * @return array
     */
    public static function getFullTcaForSysLanguageUid()
    {
        return [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0],
                ],
            ],
        ];
    }

    /**
     * @param string $table
     *
     * @return array
     */
    public static function getFullTcaForL10nParent($table)
    {
        return [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => $table,
                'foreign_table_where' => 'AND ' . $table . '.pid=###CURRENT_PID### AND ' . $table . '.sys_language_uid IN (-1,0)',
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getFullTcaForL10nDiffsource()
    {
        return [
            'config' => [
                'type' => 'passthrough',
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getFullTcaForT3verLabel()
    {
        return [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getFullTcaForHidden()
    {
        return [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getFullTcaForStartTime()
    {
        return [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function getFullTcaForEndTime()
    {
        return [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ],
            ],
        ];
    }

    /**
     * @param string $table
     *
     * @return array
     */
    public static function getPleaseChooseOption($table = '')
    {
        $icon = '';

        if ($table !== '') {
            $icon = ExtensionManagementUtility::extRelPath('in2studyfinder') . 'Resources/Public/Icons/' . $table . '.png';
        }

        return [
            'LLL:EXT:in2studyfinder/Resources/Private/Language/locallang_db.xlf:tca.select.please_choose',
            '',
            $icon,
        ];
    }

    /**
     * @param string $label
     * @param string $table
     * @param int $minItems
     * @param int $exclude
     *
     * @return array
     */
    public static function getFullTcaForSingleSelect(
        $label,
        $table,
        $exclude = 1,
        $minItems = 0
    ) {
        return [
            'exclude' => $exclude,
            'l10n_mode' => 'exclude',
            'label' => $label,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => $table,
                'foreign_table_where' => 'AND sys_language_uid in (-1, 0)',
                'items' => [self::getPleaseChooseOption($table)],
                'minitems' => $minItems,
            ],
        ];
    }

    /**
     * @param $label
     * @param $table
     * @param $mmTable
     * @param int $exclude
     * @param int $minItems
     * @param int $maxItems
     *
     * @return array
     */
    public static function getFullTcaForSelectCheckBox(
        $label,
        $table,
        $mmTable,
        $exclude = 1,
        $minItems = 0,
        $maxItems = 5
    ) {
        /**
         * Compatibility for Typo3 6.2 LTS
         */
        if (VersionUtility::isTypo3MajorVersionBelow(7)) {
            return self::getFullTcaForSelectSideBySide($label, $table, $mmTable);
        } else {
            return [
                'exclude' => $exclude,
                'l10n_mode' => 'exclude',
                'label' => $label,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectCheckBox',
                    'foreign_table' => $table,
                    'MM' => $mmTable,
                    'foreign_table_where' => 'AND sys_language_uid in (-1, 0)',
                    'minitems' => $minItems,
                    'maxitems' => $maxItems,
                ],
            ];
        }
    }

    /**
     * @param $label
     * @param $table
     * @param $mmTable
     * @param int $exclude
     * @param int $minItems
     * @param int $maxItems
     *
     * @return array
     */
    public static function getFullTcaForSelectSideBySide(
        $label,
        $table,
        $mmTable,
        $exclude = 1,
        $minItems = 0,
        $maxItems = 9999
    ) {
        if (VersionUtility::isTypo3MajorVersionBelow(7)) {
            return [
                'exclude' => $exclude,
                'l10n_mode' => 'exclude',
                'label' => $label,
                'config' => [
                    'type' => 'select',
                    'foreign_table' => $table,
                    'MM' => $mmTable,
                    'foreign_table_where' => 'AND sys_language_uid in (-1, 0)',
                    'size' => 5,
                    'autoSizeMax' => 30,
                    'maxitems' => 9999,
                    'multiple' => 0,
                    'wizards' => [
                        'suggest' => [
                            'type' => 'suggest',
                        ],
                    ],
                ],
            ];
        } else {
            return [
                'exclude' => $exclude,
                'l10n_mode' => 'exclude',
                'label' => $label,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'foreign_table' => $table,
                    'MM' => $mmTable,
                    'foreign_table_where' => 'AND sys_language_uid in (-1, 0)',
                    'minitems' => $minItems,
                    'maxitems' => $maxItems,
                    'wizards' => [
                        'suggest' => [
                            'type' => 'suggest',
                        ],
                    ],
                ],
            ];
        }
    }

    /**
     * returns the TCA for an suggest wizard
     *
     * @return array
     */
    public static function getSuggestWizard()
    {
        return [
            'suggest' => [
                'type' => 'suggest',
            ],
        ];
    }

    /**
     * returns the TCA for an link wizard
     *
     * @param string $blindLinkOptions
     * @param string $allowedExtensions
     * @param string $blindLinkFields
     *
     * @return array
     */
    public static function getLinkWizard(
        $blindLinkOptions = '',
        $allowedExtensions = '*',
        $blindLinkFields = ''
    ) {
        $linkWizard = [
            'type' => 'popup',
            'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
            'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
            'params' => [
                'blindLinkOptions' => $blindLinkOptions,
                'allowedExtensions' => $allowedExtensions,
                'blindLinkFields' => $blindLinkFields
            ]
        ];

        if (VersionUtility::isTypo3MajorVersionBelow(7)) {
            $linkWizard['icon'] = 'link_popup.gif';
            $linkWizard['script'] = 'browse_links.php?mode=wizard&act=url';
        } else {
            $linkWizard['icon'] = 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif';
            $linkWizard['module'] = [
                'name' => 'wizard_link',
            ];
        }

        return $linkWizard;
    }

    /**
     * @param string $table
     * @param string $extbaseTypeValue
     * @param string $insertAfter
     * @param int $readOnly
     *
     * @return void
     */
    public static function setExtbaseType(
        $table,
        $extbaseTypeValue,
        $insertAfter = 'title',
        $readOnly = 1
    ) {
        if (!isset($GLOBALS['TCA'][$table]['ctrl']['type'])) {
            $GLOBALS['TCA'][$table]['ctrl']['type'] = 'tx_extbase_type';
            $extbaseType = [];
            $extbaseType['tx_extbase_type'] = [
                'exclude' => 1,
                'label' => 'LLL:EXT:in2studyfinder/Resources/Private/Language/locallang_db.xlf:extendedStudycourseLabel',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        [
                            'LLL:EXT:in2studyfinder/Resources/Private/Language/locallang_db.xlf:extendedStudycourse',
                            $extbaseTypeValue
                        ],
                        ['LLL:EXT:in2studyfinder/Resources/Private/Language/locallang_db.xlf:defaultStudycourse', '']
                    ],
                    'default' => $extbaseTypeValue,
                    'readOnly' => $readOnly,
                    'size' => 1,
                    'maxitems' => 1,
                ],
            ];

            ExtensionManagementUtility::addTCAcolumns($table, $extbaseType, 1);
        }

        ExtensionManagementUtility::addToAllTCAtypes($table, $GLOBALS['TCA'][$table]['ctrl']['type'], '',
            'after:' . $insertAfter);
    }

    /**
     * @param $table
     * @param $extbaseType
     * @param $field
     * @param $insertAfter
     *
     * @return void
     */
    public static function addFieldToShowItem(
        $table,
        $extbaseType,
        $field,
        $insertAfter = 'last'
    ) {
        $newShowItem = $GLOBALS['TCA'][$table]['types']['0']['showitem'];

        $fieldArray = explode(',', $newShowItem);

        array_walk($fieldArray, [self::class, 'trimValue']);

        if (in_array($insertAfter, $fieldArray)) {
            $arrayKey = array_search($insertAfter, $fieldArray) + 1;
            array_splice($fieldArray, $arrayKey, 0, [$field]);
        } else {
            array_push($fieldArray, $field);
            $fieldArray = array_filter($fieldArray);
        }

        $GLOBALS['TCA'][$table]['types'][$extbaseType]['showitem'] = implode(',', $fieldArray);
    }

    public static function addFieldsToPalette(
        $table,
        $palette,
        $fields,
        $insertAfter = 'last',
        $addLineBreakBefore = false,
        $addLineBreakAfter = false
    ) {
        $newShowItem = $GLOBALS['TCA'][$table]['palettes'][$palette]['showitem'];
        $fieldArray = explode(',', $newShowItem);
        $i = 0;
        $insertFieldArray = [];

        foreach ($fields as $field) {
            $preLineBreak = '';
            $afterLineBreak = '';

            if ($addLineBreakBefore) {
                $preLineBreak = '--linebreak--,';
            }
            if ($addLineBreakAfter) {
                $afterLineBreak = ',--linebreak--';
            }

            $insertFieldArray[$i] = $preLineBreak . $field . $afterLineBreak;

            $i++;
        }

        array_walk($fieldArray, [self::class, 'trimValue']);

        if (in_array($insertAfter, $fieldArray)) {
            $arrayKey = array_search($insertAfter, $fieldArray) + 1;
            array_splice($fieldArray, $arrayKey, 0, $insertFieldArray);
        } else {
            foreach ($insertFieldArray as $value) {
                array_push($fieldArray, $value);
            }

            $fieldArray = array_filter($fieldArray);
        }

        $GLOBALS['TCA'][$table]['palettes'][$palette]['showitem'] = implode(',', $fieldArray);
    }

    /**
     * @param $table
     * @param $palette
     * @param $field
     * @param string $insertAfter
     * @param bool|false $addLineBreakAfter
     * @param bool|false $addLineBreakBefore
     *
     * @deprecated since 1.2, will be removed in version 2.0
     *
     * @return void
     */
    public static function addFieldToPalettes(
        $table,
        $palette,
        $field,
        $insertAfter = 'last',
        $addLineBreakBefore = false,
        $addLineBreakAfter = false
    ) {
        self::addFieldsToPalette($table,$palette,[$field],$insertAfter,$addLineBreakBefore,$addLineBreakAfter);
    }

    /**
     * Use addFieldsToNewDiv instead
     *
     * @param string $table
     * @param string $localLangPath
     * @param string $localLangId
     * @param array $fields
     * @param string $insertAfter
     *
     * @deprecated since 1.2, will be removed in version 2.0
     *
     * @return void
     */
    public static function addFieldsInNewDiv(
        $table,
        $localLangPath,
        $localLangId,
        $fields,
        $insertAfter
    ) {
        self::addFieldsToNewDivForAllTCAtypes($table, $localLangPath, $localLangId, $fields, $insertAfter);
    }

    /**
     * Adds a new tab to the tca
     *
     * @param string $table
     * @param string $localLangPath
     * @param string $localLangId
     * @param array $fields
     * @param string $insertAfter
     *
     * @return void
     */
    public static function addFieldsToNewDivForAllTCAtypes(
        $table,
        $localLangPath,
        $localLangId,
        $fields,
        $insertAfter
    ) {
        $fieldString = implode(',', $fields);

        $tab = ', --div--;' . $localLangPath . ':' . $localLangId . ',' . $fieldString . ',';

        ExtensionManagementUtility::addToAllTCAtypes($table, $tab, '', 'after:' . $insertAfter);
    }

    /**
     * Adds fields to an existing tca tab for all TCA types
     *
     * @param string $table
     * @param string $tcaType the TCA 'type'
     * @param string $ll the language File
     * @param string $div
     * @param array $fields
     *
     * @return void
     */
    public static function addFieldsToDivForTCAtype(
        $table,
        $tcaType,
        $ll,
        $div,
        $fields
    ) {

    }

    public static function removeFieldsFromTCApalette(
        $table,
        $palette,
        $fields
    ) {
        self::removeFieldsFromTCA($table, 'palettes', $palette, $fields);
    }

    /**
     * @param string $table
     * @param string $palette
     * @param string $field
     *
     * @deprecated since 1.2, will be removed in version 2.0
     *
     * @return void
     */
    public static function removeFieldFromPaletteShowItem(
        $table,
        $palette,
        $field
    ) {
        self::removeFieldsFromTCApalette($table, $palette, [$field]);
    }

    /**
     * @param string $table
     * @param string $tcaType
     * @param array $fields
     *
     * @return void
     */
    public static function removeFieldsFromTCAtype(
        $table,
        $tcaType,
        $fields
    ) {
        self::removeFieldsFromTCA($table, 'types', $tcaType, $fields);
    }

    /**
     * @param string $table
     * @param string $type
     * @param string $field
     *
     * @deprecated since 1.2, will be removed in version 2.0
     *
     * @return void
     */
    public static function removeFieldFromShowItem(
        $table,
        $type,
        $field
    ) {
        self::removeFieldsFromTCAtype($table, $type, [$field]);
    }

    /**
     * removes fields from the TCA
     *
     * @param string $table
     * @param string $section 'types' or 'palettes'
     * @param string $sectionName
     * @param array $fields
     *
     * @return bool
     */
    private static function removeFieldsFromTCA(
        $table,
        $section,
        $sectionName,
        $fields
    ) {
        $status = true;

        if ($section !== 'types' && $section !== 'palettes') {
            $status = false;
        }

        if ($status) {
            $showItemArray = explode(',', $GLOBALS['TCA'][$table][$section][$sectionName]['showitem']);
            
            array_walk($showItemArray, [self::class, 'trimValue']);

            foreach ($fields as $field) {
                if (in_array($field, $showItemArray)) {
                    unset($showItemArray[array_search($field, $showItemArray)]);
                }
            }

            $GLOBALS['TCA'][$table][$section][$sectionName]['showitem'] = implode(',', $showItemArray);
        }

        return $status;
    }

    /**
     * @param string $value
     */
    private static function trimValue(&$value)
    {
        $value = trim($value);
    }
}
