| laravel-socialmedia 	| facebook    	| twitter                                                     	| instagram                          	| pinterest 	| Google + |
|---------------------	|-------------	|-------------------------------------------------------------	|------------------------------------	|-----------	| -------- |
| message             	| message     	| status                                                      	| Hacky API i need to figure out first 	| note      	| object.originalContent |
| link                	| link        	|                                                             	|                                    	| link?     	| object.attachments[].url |
| picture             	| picture     	|                                                             	|                                    	| image_url 	| object.attachments[] |
| name                	| name        	|                                                             	|                                    	|           	|  |
| caption             	| caption     	|                                                             	|                                    	|           	|  |
| description         	| description 	|                                                             	|                                    	|           	|  |
| place               	| place       	|                                                             	|                                    	|           	|  |
| tags                	| tags        	|                                                             	|                                    	|           	|  |
| privacy             	| privacy     	|                                                             	|                                    	|           	|  |
| targeting           	| targeting   	|                                                             	|                                    	|           	| access |
|                     	|             	| lat                                                         	|                                    	|           	|  |
|                     	|             	| long                                                        	|                                    	|           	|  |
|                     	|             	| place_id (Twitter internal)                                 	|                                    	|           	|  |
|                     	|             	| display_coordinates                                         	|                                    	|           	|  |
|                     	|             	| media_ids (First need to upload attachments up to 4 photos) 	|                                    	|           	|  |
|                     	|             	| possibly_sensitive                                          	|                                    	|           	|  |
|                     	|             	| in_reply_to_status_id                                       	|                                    	|           	|  |
|                     	|             	|                                                             	|                                    	| board     	|  |
|                       |               |                                                               |                                       |               | verb = "post" |