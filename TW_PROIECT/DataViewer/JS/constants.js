const CONTAINERS_ID = ['custom_containers', 'tf_containers', 'data_containers', 'between_containers'];

const CONTAINERS = {
                        'tf_containers':['amenity', 'traffic_calming', 'bump', 
                                        'roundabout', 'station', 'crossing', 
                                        'give_way', 'junction', 'no_exit', 
                                        'traffic_signal', 'turn_loop', 'rail_way', 
                                        'stop'],
                        
                        'custom_containers':['side', 'severity', 'sunrise_sunset', 
                                             'civil_twilight', 'nautical_twilight', 'astronomical_twilight'],
                        
                        'between_containers':['start_lat', 'start_lng', 'distance',
                                              'street_nb', 'temperature', 'wind_chill',
                                              'humidity', 'pressure', 'visibility', 
                                              'wind_speed', 'precipitation'],
                        
                        'data_containers':['source', 'state', 'county', 
                                          'city', 'street_name', 'timezone',
                                          'airport_code', 'wind_direction', 'weather_condition']
                                    
};

