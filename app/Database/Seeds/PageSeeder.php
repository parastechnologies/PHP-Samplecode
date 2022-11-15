<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
	{
		$data = [
                    [
                        'title' => 'Privacy Policy',
                        'content' => '<!doctype html>
                            <html lang="en">
                            
                            <head>
                                <!-- Required meta tags -->
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                <link
                                    href="https://fonts.googleapis.com/css2?family=Eagle+Lake&family=Fondamento&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Style+Script&display=swap"
                                    rel="stylesheet">
                                <title>Privacy Policy</title>
                                <style>
                                    .content_block {
                                        font-family: "Open Sans", sans-serif;
                                        padding: 4px 20px;
                                    }
                            
                                    .content_block h1 {
                                        font-size: 22px;
                                        color: #2D63EB
                                    }
                            
                             .content_block p {
                                font-size: 14px;
                                color: #61676c;
                                line-height: 22px;
                            }
                            
                                    .content_block h2 {
                                        font-size: 16px;
                                        color:#005288;
                                    }
                            
                                    .content_block ul li {
                                        font-size: 14px;
                                        color: #1D1D1D;
                                        list-style-type: auto;
                                        padding-bottom: 12px;
                                    }
                                    ul.listing-block li {
                                list-style: none;
                            }
                            ul.listing-block {
                                margin: 0px;
                                padding: 0px;
                            }
                                </style>
                            </head>
                            
                            <body>
                                <div class="content_block">
                            <h1>PRIVACY POLICY</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta libero id sapien facilisis rutrum. Nulla sagittis dui non est rhoncus, vel euismod ante sodales. Nulla egestas quam turpis, vel rhoncus lacus efficitur sed. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse feugiat tellus eu feugiat feugiat. In hac habitasse platea dictumst. Aliquam erat volutpat.</p>
                                    <p>Proin est arcu, egestas id sem ut, efficitur posuere tellus. Integer pharetra massa quis orci lobortis finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec sit amet sapien nec tellus volutpat tempor eget vitae nulla. Sed dignissim, augue sit amet sagittis accumsan, metus lacus dapibus magna, nec iaculis dolor justo vitae turpis. Vivamus viverra velit cursus eros scelerisque, sit amet maximus nisl laoreet.</p>
                                    <p>Donec sed sodales mauris. Duis accumsan dui quis odio commodo mattis. Curabitur id viverra sem. Vivamus nulla libero, ultrices sit amet ornare et, scelerisque ut orci. </p>
                                    <p>Mauris et purus ultricies, ornare nulla et, consequat dolor. Phasellus non ex pretium arcu porttitor varius. Nunc porta diam in neque sollicitudin laoreet. Pellentesque sed lorem congue, consequat lectus ut, scelerisque est. Suspendisse efficitur orci id facilisis fringilla. In aliquam hendrerit interdum. </p>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis vestibulum sem id tincidunt maximus. Mauris lobortis accumsan nisl in fringilla. Nunc fermentum nunc id neque commodo mattis. Ut sit amet placerat ex. Quisque aliquet nunc sed tortor euismod aliquam id quis turpis. Pellentesque quis nibh in leo gravida elementum
                                    </p>
                                    <h2>  Phasellus non ex pretium</h2>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis</p>
                                    <h2>Duis accumsan dui quis odio commodo  </h2>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis vestibulum sem id tincidunt maximus. Mauris lobortis accumsan nisl in fringilla. Nunc fermentum nunc id neque commodo mattis. </p>
                                    <h2>Derivative Data </h2>
                                    <p>Maecenas vehicula vel dolor id elementum. Cras vestibulum eros urna, vulputate aliquam odio vulputate ac. Aliquam dapibus odio ut ex eleifend ultrices. Aenean sagittis tristique tellus,  </p>
                                    <h2>Financial Data </h2>
                                    <p>Vestibulum vehicula ante mauris, sit amet tristique massa commodo eu. Fusce cursus enim non blandit tristique. Praesent mi dolor, ultrices a ultricies vitae, pellentesque ut neque. In efficitur eu est ornare auctor. Quisque faucibus rhoncus egestas. Quisque bibendum pulvinar eleifend. Aliquam nec mattis dui. Duis non justo sed quam lobortis egestas vel et massa. Etiam ullamcorper, urna id ultrices ornare, elit tortor faucibus libero, varius euismod erat neque ut velit. Fusce eget sapien mollis, rhoncus mi id, mollis turpis. Nunc non venenatis ligula. Donec feugiat suscipit velit a bibendum.
                                    </p></div>
                            </body>
                            </html>',
                        'type' => 'privacy',
                        'status' => 1
                    ],
                     [
                        'title' => 'Terms & Conditions',
                        'content' => '<!doctype html>
                            <html lang="en">
                            
                            <head>
                                <!-- Required meta tags -->
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                <link
                                    href="https://fonts.googleapis.com/css2?family=Eagle+Lake&family=Fondamento&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Style+Script&display=swap"
                                    rel="stylesheet">
                                <title>Privacy Policy</title>
                                <style>
                                    .content_block {
                                        font-family: "Open Sans", sans-serif;
                                        padding: 4px 20px;
                                    }
                            
                                    .content_block h1 {
                                        font-size: 22px;
                                        color: #2D63EB
                                    }
                            
                             .content_block p {
                                font-size: 14px;
                                color: #61676c;
                                line-height: 22px;
                            }
                            
                                    .content_block h2 {
                                        font-size: 16px;
                                        color:#005288;
                                    }
                            
                                    .content_block ul li {
                                        font-size: 14px;
                                        color: #1D1D1D;
                                        list-style-type: auto;
                                        padding-bottom: 12px;
                                    }
                                    ul.listing-block li {
                                list-style: none;
                            }
                            ul.listing-block {
                                margin: 0px;
                                padding: 0px;
                            }
                                </style>
                            </head>
                            
                            <body>
                                <div class="content_block">
                            <h1>PRIVACY POLICY</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam porta libero id sapien facilisis rutrum. Nulla sagittis dui non est rhoncus, vel euismod ante sodales. Nulla egestas quam turpis, vel rhoncus lacus efficitur sed. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse feugiat tellus eu feugiat feugiat. In hac habitasse platea dictumst. Aliquam erat volutpat.</p>
                                    <p>Proin est arcu, egestas id sem ut, efficitur posuere tellus. Integer pharetra massa quis orci lobortis finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec sit amet sapien nec tellus volutpat tempor eget vitae nulla. Sed dignissim, augue sit amet sagittis accumsan, metus lacus dapibus magna, nec iaculis dolor justo vitae turpis. Vivamus viverra velit cursus eros scelerisque, sit amet maximus nisl laoreet.</p>
                                    <p>Donec sed sodales mauris. Duis accumsan dui quis odio commodo mattis. Curabitur id viverra sem. Vivamus nulla libero, ultrices sit amet ornare et, scelerisque ut orci. </p>
                                    <p>Mauris et purus ultricies, ornare nulla et, consequat dolor. Phasellus non ex pretium arcu porttitor varius. Nunc porta diam in neque sollicitudin laoreet. Pellentesque sed lorem congue, consequat lectus ut, scelerisque est. Suspendisse efficitur orci id facilisis fringilla. In aliquam hendrerit interdum. </p>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis vestibulum sem id tincidunt maximus. Mauris lobortis accumsan nisl in fringilla. Nunc fermentum nunc id neque commodo mattis. Ut sit amet placerat ex. Quisque aliquet nunc sed tortor euismod aliquam id quis turpis. Pellentesque quis nibh in leo gravida elementum
                                    </p>
                                    <h2>  Phasellus non ex pretium</h2>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis</p>
                                    <h2>Duis accumsan dui quis odio commodo  </h2>
                                    <p>In hac habitasse platea dictumst. Integer lobortis sapien ut erat interdum imperdiet. Aenean nec viverra nisi, a lacinia libero. Praesent et condimentum turpis. Duis nec vestibulum dui. Duis vestibulum sem id tincidunt maximus. Mauris lobortis accumsan nisl in fringilla. Nunc fermentum nunc id neque commodo mattis. </p>
                                    <h2>Derivative Data </h2>
                                    <p>Maecenas vehicula vel dolor id elementum. Cras vestibulum eros urna, vulputate aliquam odio vulputate ac. Aliquam dapibus odio ut ex eleifend ultrices. Aenean sagittis tristique tellus,  </p>
                                    <h2>Financial Data </h2>
                                    <p>Vestibulum vehicula ante mauris, sit amet tristique massa commodo eu. Fusce cursus enim non blandit tristique. Praesent mi dolor, ultrices a ultricies vitae, pellentesque ut neque. In efficitur eu est ornare auctor. Quisque faucibus rhoncus egestas. Quisque bibendum pulvinar eleifend. Aliquam nec mattis dui. Duis non justo sed quam lobortis egestas vel et massa. Etiam ullamcorper, urna id ultrices ornare, elit tortor faucibus libero, varius euismod erat neque ut velit. Fusce eget sapien mollis, rhoncus mi id, mollis turpis. Nunc non venenatis ligula. Donec feugiat suscipit velit a bibendum.
                                    </p></div>
                            </body>
                            </html>',
                        'type' => 'terms',
                        'status' => 1
                    ],
                    [
                        'title' => 'Terms & Conditions',
                        'content' => 'ef',
                        'type' => 'termsweb',
                        'status' => 0
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'content' => 'dsfsdf',
                        'type' => 'privacyweb',
                        'status' => 0
                    ],
                    [
                        'title' => 'Shipping Policy',
                        'content' => 'dfdsf',
                        'type' => 'shipping',
                        'status' => 0
                    ],
                    [
                        'title' => 'Refund Policy',
                        'content' => 'dfsd',
                        'type' => 'refund',
                        'status' => 0
                    ],
                ];
                
                $this->db->table("tbl_pages")->truncate();
                $this->db->table('tbl_pages')->insertBatch($data);
               // echo $this->db->getLastQuery();
	}            
}
