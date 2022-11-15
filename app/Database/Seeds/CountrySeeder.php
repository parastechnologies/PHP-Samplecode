<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CountrySeeder extends Seeder
{
     public function run()
        {
            $db = \Config\Database::connect();
            $db->query("INSERT INTO tbl_countries 
            (id, countryName, countryCode, dialCode,currency , currencySymbol, currencyCode,status) VALUES
                (1, 'Afghanistan', 'AF', '+93', 'Afghan afghani', '؋', 'AFN',0),
                
                (2, 'Aland Islands', 'AX', '+358',' ”',' ”',' ”',0),
                
                (3, 'Albania', 'AL', '+355', 'Albanian lek', 'L', 'ALL',0),
                
                (4, 'Algeria', 'DZ', '+213', 'Algerian dinar', 'د.ج', 'DZD',0),
                
                (5, 'AmericanSamoa', 'AS', '+1684',' ”',' ”',' ”',0),
                
                (6, 'Andorra', 'AD', '+376', 'Euro', '€', 'EUR',0),
                
                (7, 'Angola', 'AO', '+244', 'Angolan kwanza', 'Kz', 'AOA',0),
                
                (8, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', '$', 'XCD',0),
                
                (9, 'Antarctica', 'AQ', '+672',' ”',' ”',' ”',0),
                
                (10, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', '$', 'XCD',0),
                
                (11, 'Argentina', 'AR', '+54', 'Argentine peso', '$', 'ARS',0),
                
                (12, 'Armenia', 'AM', '+374', 'Armenian dram',' ”', 'AMD',0),
                
                (13, 'Aruba', 'AW', '+297', 'Aruban florin', 'ƒ', 'AWG',0),
                
                (14, 'Australia', 'AU', '+61', 'Australian dollar', '$', 'AUD',1),
                
                (15, 'Austria', 'AT', '+43', 'Euro', '€', 'EUR',1),
                
                (16, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat',' ”', 'AZN',0),
                
                (17, 'Bahamas', 'BS', '+1242',' ”',' ”',' ”',0),
                
                (18, 'Bahrain', 'BH', '+973', 'Bahraini dinar', '.د.ب', 'BHD',0),
                
                (19, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', '৳', 'BDT',0),
                
                (20, 'Barbados', 'BB', '+1246', 'Barbadian dollar', '$', 'BBD',0),
                
                (21, 'Belarus', 'BY', '+375', 'Belarusian ruble', 'Br', 'BYR',0),
                
                (22, 'Belgium', 'BE', '+32', 'Euro', '€', 'EUR',1),
                
                (23, 'Belize', 'BZ', '+501', 'Belize dollar', '$', 'BZD',0),
                
                (24, 'Benin', 'BJ', '+229', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (25, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', '$', 'BMD',0),
                
                (26, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 'Nu.', 'BTN',0),
                
                (27, 'Bolivia, Plurination', 'BO', '+591',' ”',' ”',' ”',0),
                
                (28, 'Bosnia and Herzegovi', 'BA', '+387',' ”',' ”',' ”',0),
                
                (29, 'Botswana', 'BW', '+267', 'Botswana pula', 'P', 'BWP',0),
                
                (30, 'Brazil', 'BR', '+55', 'Brazilian real', 'R$', 'BRL',1),
                
                (31, 'British Indian Ocean', 'IO', '+246',' ”',' ”',' ”',0),
                
                (32, 'Brunei Darussalam', 'BN', '+673',' ”',' ”',' ”',0),
                
                (33, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', 'лв', 'BGN',1),
                
                (34, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (35, 'Burundi', 'BI', '+257', 'Burundian franc', 'Fr', 'BIF',0),
                
                (36, 'Cambodia', 'KH', '+855', 'Cambodian riel', '៛', 'KHR',0),
                
                (37, 'Cameroon', 'CM', '+237', 'Central African CFA ', 'Fr', 'XAF',0),
                
                (38, 'Canada', 'CA', '+1', 'Canadian dollar', '$', 'CAD',1),
                
                (39, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 'Esc or $', 'CVE',0),
                
                (40, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', '$', 'KYD',0),
                
                (41, 'Central African Repu', 'CF', '+236',' ”',' ”',' ”',0),
                
                (42, 'Chad', 'TD', '+235', 'Central African CFA ', 'Fr', 'XAF',0),
                
                (43, 'Chile', 'CL', '+56', 'Chilean peso', '$', 'CLP',0),
                
                (44, 'China', 'CN', '+86', 'Chinese yuan', '¥ or 元', 'CNY',0),
                
                (45, 'Christmas Island', 'CX', '+61',' ”',' ”',' ”',0),
                
                (46, 'Cocos (Keeling) Isla', 'CC', '+61',' ”',' ”',' ”',0),
                
                (47, 'Colombia', 'CO', '+57', 'Colombian peso', '$', 'COP',0),
                
                (48, 'Comoros', 'KM', '+269', 'Comorian franc', 'Fr', 'KMF',0),
                
                (49, 'Congo', 'CG', '+242',' ”',' ”',' ”',0),
                
                (50, 'Congo, The Democrati', 'CD', '+243',' ”',' ”',' ”',0),
                
                (51, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', '$', 'NZD',0),
                
                (52, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', '₡', 'CRC',0),
                
                (53, 'Cote d”Ivoire', 'CI', '+225', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (54, 'Croatia', 'HR', '+385', 'Croatian kuna', 'kn', 'HRK',0),
                
                (55, 'Cuba', 'CU', '+53', 'Cuban convertible pe', '$', 'CUC',0),
                
                (56, 'Cyprus', 'CY', '+357', 'Euro', '€', 'EUR',1),
                
                (57, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 'Kč', 'CZK',1),
                
                (58, 'Denmark', 'DK', '+45', 'Danish krone', 'kr', 'DKK',1),
                
                (59, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 'Fr', 'DJF',0),
                
                (60, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', '$', 'XCD',0),
                
                (61, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', '$', 'DOP',0),
                
                (62, 'Ecuador', 'EC', '+593', 'United States dollar', '$', 'USD',0),
                
                (63, 'Egypt', 'EG', '+20', 'Egyptian pound', '£ or ج.م', 'EGP',0),
                
                (64, 'El Salvador', 'SV', '+503', 'United States dollar', '$', 'USD',0),
                
                (65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 'Fr', 'XAF',0),
                
                (66, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 'Nfk', 'ERN',0),
                
                (67, 'Estonia', 'EE', '+372', 'Euro', '€', 'EUR',1),
                
                (68, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 'Br', 'ETB',0),
                
                (69, 'Falkland Islands (Ma', 'FK', '+500',' ”',' ”',' ”',0),
                
                (70, 'Faroe Islands', 'FO', '+298', 'Danish krone', 'kr', 'DKK',0),
                
                (71, 'Fiji', 'FJ', '+679', 'Fijian dollar', '$', 'FJD',0),
                
                (72, 'Finland', 'FI', '+358', 'Euro', '€', 'EUR',1),
                
                (73, 'France', 'FR', '+33', 'Euro', '€', 'EUR',1),
                
                (74, 'French Guiana', 'GF', '+594',' ”',' ”',' ”',0),
                
                (75, 'French Polynesia', 'PF', '+689', 'CFP franc', 'Fr', 'XPF',0),
                
                (76, 'Gabon', 'GA', '+241', 'Central African CFA ', 'Fr', 'XAF',0),
                
                (77, 'Gambia', 'GM', '+220',' ”',' ”',' ”',0),
                
                (78, 'Georgia', 'GE', '+995', 'Georgian lari', 'ლ', 'GEL',0),
                
                (79, 'Germany', 'DE', '+49', 'Euro', '€', 'EUR',1),
                
                (80, 'Ghana', 'GH', '+233', 'Ghana cedi', '₵', 'GHS',0),
                
                (81, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', '£', 'GIP',0),
                
                (82, 'Greece', 'GR', '+30', 'Euro', '€', 'EUR',1),
                
                (83, 'Greenland', 'GL', '+299',' ”',' ”',' ”',0),
                
                (84, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', '$', 'XCD',0),
                
                (85, 'Guadeloupe', 'GP', '+590',' ”',' ”',' ”',0),
                
                (86, 'Guam', 'GU', '+1671',' ”',' ”',' ”',0),
                
                (87, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 'Q', 'GTQ',0),
                
                (88, 'Guernsey', 'GG', '+44', 'British pound', '£', 'GBP',0),
                
                (89, 'Guinea', 'GN', '+224', 'Guinean franc', 'Fr', 'GNF',0),
                
                (90, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (91, 'Guyana', 'GY', '+595', 'Guyanese dollar', '$', 'GYD',0),
                
                (92, 'Haiti', 'HT', '+509', 'Haitian gourde', 'G', 'HTG',0),
                
                (93, 'Holy See (Vatican Ci', 'VA', '+379',' ”',' ”',' ”',0),
                
                (94, 'Honduras', 'HN', '+504', 'Honduran lempira', 'L', 'HNL',0),
                
                (95, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', '$', 'HKD',1),
                
                (96, 'Hungary', 'HU', '+36', 'Hungarian forint', 'Ft', 'HUF',1),
                
                (97, 'Iceland', 'IS', '+354', 'Icelandic króna', 'kr', 'ISK',0),
                
                (98, 'India', 'IN', '+91', 'Indian rupee', '₹', 'INR',1),
                
                (99, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 'Rp', 'IDR',0),
                
                (100, 'Iran, Islamic Republ', 'IR', '+98',' ”',' ”',' ”',0),
                
                (101, 'Iraq', 'IQ', '+964', 'Iraqi dinar', 'ع.د', 'IQD',0),
                
                (102, 'Ireland', 'IE', '+353', 'Euro', '€', 'EUR',1),
                
                (103, 'Isle of Man', 'IM', '+44', 'British pound', '£', 'GBP',0),
                
                (104, 'Israel', 'IL', '+972', 'Israeli new shekel', '₪', 'ILS',0),
                
                (105, 'Italy', 'IT', '+39', 'Euro', '€', 'EUR',1),
                
                (106, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', '$', 'JMD',0),
                
                (107, 'Japan', 'JP', '+81', 'Japanese yen', '¥', 'JPY',1),
                
                (108, 'Jersey', 'JE', '+44', 'British pound', '£', 'GBP',0),
                
                (109, 'Jordan', 'JO', '+962', 'Jordanian dinar', 'د.ا', 'JOD',0),
                
                (110, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge',' ”', 'KZT',0),
                
                (111, 'Kenya', 'KE', '+254', 'Kenyan shilling', 'Sh', 'KES',0),
                
                (112, 'Kiribati', 'KI', '+686', 'Australian dollar', '$', 'AUD',0),
                
                (113, 'Korea, Democratic Pe', 'KP', '+850',' ”',' ”',' ”',0),
                
                (114, 'Korea, Republic of S', 'KR', '+82',' ”',' ”',' ”',0),
                
                (115, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', 'د.ك', 'KWD',0),
                
                (116, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', 'лв', 'KGS',0),
                
                (117, 'Laos', 'LA', '+856', 'Lao kip', '₭', 'LAK',0),
                
                (118, 'Latvia', 'LV', '+371', 'Euro', '€', 'EUR',1),
                
                (119, 'Lebanon', 'LB', '+961', 'Lebanese pound', 'ل.ل', 'LBP',0),
                
                (120, 'Lesotho', 'LS', '+266', 'Lesotho loti', 'L', 'LSL',0),
                
                (121, 'Liberia', 'LR', '+231', 'Liberian dollar', '$', 'LRD',0),
                
                (122, 'Libyan Arab Jamahiri', 'LY', '+218',' ”',' ”',' ”',0),
                
                (123, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 'Fr', 'CHF',0),
                
                (124, 'Lithuania', 'LT', '+370', 'Euro', '€', 'EUR',1),
                
                (125, 'Luxembourg', 'LU', '+352', 'Euro', '€', 'EUR',1),
                
                (126, 'Macao', 'MO', '+853',' ”',' ”',' ”',0),
                
                (127, 'Macedonia', 'MK', '+389',' ”',' ”',' ”',0),
                
                (128, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 'Ar', 'MGA',0),
                
                (129, 'Malawi', 'MW', '+265', 'Malawian kwacha', 'MK', 'MWK',0),
                
                (130, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 'RM', 'MYR',1),
                
                (131, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', '.ރ', 'MVR',0),
                
                (132, 'Mali', 'ML', '+223', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (133, 'Malta', 'MT', '+356', 'Euro', '€', 'EUR',1),
                
                (134, 'Marshall Islands', 'MH', '+692', 'United States dollar', '$', 'USD',0),
                
                (135, 'Martinique', 'MQ', '+596',' ”',' ”',' ”',0),
                
                (136, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 'UM', 'MRO',0),
                
                (137, 'Mauritius', 'MU', '+230', 'Mauritian rupee', '₨', 'MUR',0),
                
                (138, 'Mayotte', 'YT', '+262',' ”',' ”',' ”',0),
                
                (139, 'Mexico', 'MX', '+52', 'Mexican peso', '$', 'MXN',1),
                
                (140, 'Micronesia, Federate', 'FM', '+691',' ”',' ”',' ”',0),
                
                (141, 'Moldova', 'MD', '+373', 'Moldovan leu', 'L', 'MDL',0),
                
                (142, 'Monaco', 'MC', '+377', 'Euro', '€', 'EUR',0),
                
                (143, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', '₮', 'MNT',0),
                
                (144, 'Montenegro', 'ME', '+382', 'Euro', '€', 'EUR',0),
                
                (145, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', '$', 'XCD',0),
                
                (146, 'Morocco', 'MA', '+212', 'Moroccan dirham', 'د.م.', 'MAD',0),
                
                (147, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 'MT', 'MZN',0),
                
                (148, 'Myanmar', 'MM', '+95', 'Burmese kyat', 'Ks', 'MMK',0),
                
                (149, 'Namibia', 'NA', '+264', 'Namibian dollar', '$', 'NAD',0),
                
                (150, 'Nauru', 'NR', '+674', 'Australian dollar', '$', 'AUD',0),
                
                (151, 'Nepal', 'NP', '+977', 'Nepalese rupee', '₨', 'NPR',0),
                
                (152, 'Netherlands', 'NL', '+31', 'Euro', '€', 'EUR',1),
                
                (153, 'Netherlands Antilles', 'AN', '+599',' ”',' ”',' ”',0),
                
                (154, 'New Caledonia', 'NC', '+687', 'CFP franc', 'Fr', 'XPF',0),
                
                (155, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', '$', 'NZD',1),
                
                (156, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 'C$', 'NIO',0),
                
                (157, 'Niger', 'NE', '+227', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (158, 'Nigeria', 'NG', '+234', 'Nigerian naira', '₦', 'NGN',0),
                
                (159, 'Niue', 'NU', '+683', 'New Zealand dollar', '$', 'NZD',0),
                
                (160, 'Norfolk Island', 'NF', '+672',' ”',' ”',' ”',0),
                
                (161, 'Northern Mariana Isl', 'MP', '+1670',' ”',' ”',' ”',0),
                
                (162, 'Norway', 'NO', '+47', 'Norwegian krone', 'kr', 'NOK',1),
                
                (163, 'Oman', 'OM', '+968', 'Omani rial', 'ر.ع.', 'OMR',0),
                
                (164, 'Pakistan', 'PK', '+92', 'Pakistani rupee', '₨', 'PKR',0),
                
                (165, 'Palau', 'PW', '+680', 'Palauan dollar', '$',' ”',0),
                
                (166, 'Palestinian Territor', 'PS', '+970',' ”',' ”',' ”',0),
                
                (167, 'Panama', 'PA', '+507', 'Panamanian balboa', 'B/.', 'PAB',0),
                
                (168, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 'K', 'PGK',0),
                
                (169, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', '₲', 'PYG',0),
                
                (170, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 'S/.', 'PEN',0),
                
                (171, 'Philippines', 'PH', '+63', 'Philippine peso', '₱', 'PHP',0),
                
                (172, 'Pitcairn', 'PN', '+872',' ”',' ”',' ”',0),
                
                (173, 'Poland', 'PL', '+48', 'Polish z?oty', 'zł', 'PLN',1),
                
                (174, 'Portugal', 'PT', '+351', 'Euro', '€', 'EUR',1),
                
                (175, 'Puerto Rico', 'PR', '+1939',' ”',' ”',' ”',0),
                
                (176, 'Qatar', 'QA', '+974', 'Qatari riyal', 'ر.ق', 'QAR',0),
                
                (177, 'Romania', 'RO', '+40', 'Romanian leu', 'lei', 'RON',1),
                
                (178, 'Russia', 'RU', '+7', 'Russian ruble',' ”', 'RUB',0),
                
                (179, 'Rwanda', 'RW', '+250', 'Rwandan franc', 'Fr', 'RWF',0),
                
                (180, 'Reunion', 'RE', '+262',' ”',' ”',' ”',0),
                
                (181, 'Saint Barthelemy', 'BL', '+590',' ”',' ”',' ”',0),
                
                (182, 'Saint Helena, Ascens', 'SH', '+290',' ”',' ”',' ”',0),
                
                (183, 'Saint Kitts and Nevi', 'KN', '+1869',' ”',' ”',' ”',0),
                
                (184, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', '$', 'XCD',0),
                
                (185, 'Saint Martin', 'MF', '+590',' ”',' ”',' ”',0),
                
                (186, 'Saint Pierre and Miq', 'PM', '+508',' ”',' ”',' ”',0),
                
                (187, 'Saint Vincent and th', 'VC', '+1784',' ”',' ”',' ”',0),
                
                (188, 'Samoa', 'WS', '+685', 'Samoan t?l?', 'T', 'WST',0),
                
                (189, 'San Marino', 'SM', '+378', 'Euro', '€', 'EUR',0),
                
                (190, 'Sao Tome and Princip', 'ST', '+239',' ”',' ”',' ”',0),
                
                (191, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', 'ر.س', 'SAR',0),
                
                (192, 'Senegal', 'SN', '+221', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (193, 'Serbia', 'RS', '+381', 'Serbian dinar', 'дин. or din.', 'RSD',0),
                
                (194, 'Seychelles', 'SC', '+248', 'Seychellois rupee', '₨', 'SCR',0),
                
                (195, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 'Le', 'SLL',0),
                
                (196, 'Singapore', 'SG', '+65', 'Brunei dollar', '$', 'BND',1),
                
                (197, 'Slovakia', 'SK', '+421', 'Euro', '€', 'EUR',1),
                
                (198, 'Slovenia', 'SI', '+386', 'Euro', '€', 'EUR',1),
                
                (199, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', '$', 'SBD',0),
                
                (200, 'Somalia', 'SO', '+252', 'Somali shilling', 'Sh', 'SOS',0),
                
                (201, 'South Africa', 'ZA', '+27', 'South African rand', 'R', 'ZAR',0),
                
                (202, 'South Georgia and th', 'GS', '+500',' ”',' ”',' ”',0),
                
                (203, 'Spain', 'ES', '+34', 'Euro', '€', 'EUR',1),
                
                (204, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 'Rs or රු', 'LKR',0),
                
                (205, 'Sudan', 'SD', '+249', 'Sudanese pound', 'ج.س.', 'SDG',0),
                
                (206, 'Suriname', 'SR', '+597', 'Surinamese dollar', '$', 'SRD',0),
                
                (207, 'Svalbard and Jan May', 'SJ', '+47',' ”',' ”',' ”',0),
                
                (208, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 'L', 'SZL',0),
                
                (209, 'Sweden', 'SE', '+46', 'Swedish krona', 'kr', 'SEK',1),
                
                (210, 'Switzerland', 'CH', '+41', 'Swiss franc', 'Fr', 'CHF',1),
                
                (211, 'Syrian Arab Republic', 'SY', '+963',' ”',' ”',' ”',0),
                
                (212, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', '$', 'TWD',0),
                
                (213, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', 'ЅМ', 'TJS',0),
                
                (214, 'Tanzania, United Rep', 'TZ', '+255',' ”',' ”',' ”',0),
                
                (215, 'Thailand', 'TH', '+66', 'Thai baht', '฿', 'THB',0),
                
                (216, 'Timor-Leste', 'TL', '+670',' ”',' ”',' ”',0),
                
                (217, 'Togo', 'TG', '+228', 'West African CFA fra', 'Fr', 'XOF',0),
                
                (218, 'Tokelau', 'TK', '+690',' ”',' ”',' ”',0),
                
                (219, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 'T$', 'TOP',0),
                
                (220, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', '$', 'TTD',0),
                
                (221, 'Tunisia', 'TN', '+216', 'Tunisian dinar', 'د.ت', 'TND',0),
                
                (222, 'Turkey', 'TR', '+90', 'Turkish lira',' ”', 'TRY',0),
                
                (223, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 'm', 'TMT',0),
                
                (224, 'Turks and Caicos Isl', 'TC', '+1649',' ”',' ”',' ”',0),
                
                (225, 'Tuvalu', 'TV', '+688', 'Australian dollar', '$', 'AUD',0),
                
                (226, 'Uganda', 'UG', '+256', 'Ugandan shilling', 'Sh', 'UGX',0),
                
                (227, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', '₴', 'UAH',0),
                
                (228, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', 'د.إ', 'AED',1),
                
                (229, 'United Kingdom', 'GB', '+44', 'British pound', '£', 'GBP',1),
                
                (230, 'United States', 'US', '+1', 'United States dollar', '$', 'USD',1),
                
                (231, 'Uruguay', 'UY', '+598', 'Uruguayan peso', '$', 'UYU',0),
                
                (232, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som',' ”', 'UZS',0),
                
                (233, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 'Vt', 'VUV',0),
                
                (234, 'Venezuela, Bolivaria', 'VE', '+58',' ”',' ”',' ”',0),
                
                (235, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', '₫', 'VND',0),
                
                (236, 'Virgin Islands, Brit', 'VG', '+1284',' ”',' ”',' ”',0),
                
                (237, 'Virgin Islands, U.S.', 'VI', '+1340',' ”',' ”',' ”',0),
                
                (238, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 'Fr', 'XPF',0),
                
                (239, 'Yemen', 'YE', '+967', 'Yemeni rial', '﷼', 'YER',0),
                
                (240, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 'ZK', 'ZMW',0),
                
                (241, 'Zimbabwe', 'ZW', '+263', 'Botswana pula', 'P', 'BWP',0)");
                   // echo $db->getLastQuery();    

        }
}
