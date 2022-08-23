function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "") {

        if(@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        }else {
            return false;
        }
    }
    
    
   set_time_limit(0);
        ini_set('memory_limit', '-1');
        Artisan::call('database:import');
        
        
   public function database_installation(Request $request) {

        if(self::check_database_connection($request->DB_HOST_SECOND, $request->DB_DATABASE_SECOND, $request->DB_USERNAME_SECOND, $request->DB_PASSWORD_SECOND)) {
            $path = base_path('.env');
            if (file_exists($path)) {
                foreach ($request->types as $type) {
                    $this->writeEnvironmentFile($type, $request[$type]);
                }
                return redirect()->route('step4');
            }else {
                return redirect()->route('step3');
            }
        }else {
            return redirect()->route('step3', "database_error");
        }
    }
    
    
     $path = app()->environmentFilePath();
        $env = file_get_contents($path);

        $old_value = env($key);

        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }

        file_put_contents($path, $env);
