<h1> FORM VALIDATION</h1>


1. VALIDATION IN A CONTROLLER AND SHOW ERROR IN BLADE


// IN CONTROLLER
------------------------------------------
  public function store(Request $request){
 
         $request->validate([
             'title' => 'required',
             'body' => 'required',
             'image' => 'required',
             'vehicle' =>'required',
         ]);
 
         return back()->withInput();
 
     }
     
// IN BLADE
-----------------------------------------
     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif


@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror




------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------

2. THROUGH ARTISAN COMMAND TO MAKE MY OWN CUSTOM REQUEST


// IN COMMAND LINE

php artisan make:request StorePost
------------------------------------------------------------------

//Then in Requests>>StorePost.php

 public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
            'vehicle' =>'required',
        ];
    }
    
-----------------------------------------------------------------------    
 // IN CONTROLLER
 
       $validated = $request->validated();

---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

3. ADD CUSTOM Validation message (STOREPOST.PHP)


public function messages()
{
    return [
        'title.required' => 'A title is required',
        'body.required'  => 'A message is required',
    ];
}

---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

4. ADD CUSTION VALIDATION ATTRIBUTE (STOREPOST.PHP)

public function attributes()
{
    return [
        'email' => 'email address',
    ];
}
---------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------

5. MANUALLY CREATING VALIDATION IN CONTROLLER

  public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Store the blog post...
    }

--------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------

LARAVEL BUILT IN VALIDATION RULES

1. ACCEPTED (check for terms, is it accepted or not)
2. ACTIVE URL (check the website url is active or not, work only on internet connection)
3. after:date (will select a date after that date)
4. after_or_equal:date (will select a date equal or after the date)
5. alpha
6. array (checkbox arary)
7. Bail (Stop running validation rules after the first validation failure.)
8. before:date
9. between:min,max
10. boolean
11. confirmed
12. date
13. date_equals:date
14. digits:value
15. digits_between:min,max
16. dimensions
            The file under validation must be an image meeting the dimension constraints as specified 
            by the rule's parameters:
            
            'avatar' => 'dimensions:min_width=100,min_height=200'
            Available constraints are: min_width, max_width, min_height, max_height, width, height, ratio.
            
            A ratio constraint should be represented as width divided by height. This can be 
            specified either by a statement like 3/2 or a float like 1.5:
            
            'avatar' => 'dimensions:ratio=3/2'
            Since this rule requires several arguments, you may use the Rule::dimensions method to 
            fluently construct the rule:
            
            use Illuminate\Validation\Rule;
            
            Validator::make($data, [
                'avatar' => [
                    'required',
                    Rule::dimensions()->maxWidth(1000)->maxHeight(500)->ratio(3 / 2),
                ],
            ]);
            
17. distinct
                When working with arrays, the field under validation must not have any duplicate values.
                'foo.*.id' => 'distinct'
                
18. EMAIL 
            
            'email' => 'email:rfc,dns'
            
            The example above will apply the RFCValidation and DNSCheckValidation validations. 
            Here's a full list of validation styles you can apply:
            
            rfc: RFCValidation
            strict: NoRFCWarningsValidation
            dns: DNSCheckValidation
            spoof: SpoofCheckValidation
            filter: FilterEmailValidation
            
19. File
20. Filled
21. image
22. integer
23. ip
24. json
25. max:value
26. mimetypes:text/plain,...
            
            The file under validation must match one of the given MIME types:
            
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime'
            To determine the MIME type of the uploaded file, the file's contents will be read and the 
            framework will attempt to guess the MIME type, which may be different from the client 
            provided MIME type.
            
            
            mimes:foo,bar,...
            The file under validation must have a MIME type corresponding to one of the listed extensions.
            
            Basic Usage Of MIME Rule
            'photo' => 'mimes:jpeg,bmp,png'
            Even though you only need to specify the extensions, this rule actually validates against 
            the MIME type of the file by reading the file's contents and guessing its MIME type.
            
            A full listing of MIME types and their corresponding extensions may be found at the 
            following location: https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
            
            
27. nullable
28. numeric
29. password
                The field under validation must match the authenticated user's password. 
                You may specify an authentication guard using the rule's first parameter:
                
                'password' => 'password:api'

30. present
31. regex:pattern
        
            The field under validation must match the given regular expression.
            
            Internally, this rule uses the PHP preg_match function. The pattern specified should obey 
            the same formatting required by preg_match and thus also include valid delimiters. 
            
            For example: 'email' => 'regex:/^.+@.+$/i'.
            
            Note: When using the regex / not_regex patterns, it may be necessary to specify rules in an 
            array instead of using pipe delimiters, especially if the regular expression contains a pipe character.
        
        
32. required
            
                The field under validation must be present in the input data and
                 not empty. A field is considered "empty" if one of the following conditions are true:
                
                The value is null.
                The value is an empty string.
                The value is an empty array or empty Countable object.
                The value is an uploaded file with no path.
            
            
33. size:value
            The field under validation must have a size matching the given value. 
            For string data, value corresponds to the number of characters. For numeric data, 
            value corresponds to a given integer value (the attribute must also have the numeric or 
            integer rule). For an array, size corresponds to the count of the array. For files, 
            size corresponds to the file size in kilobytes. Let's look at some examples:
            
            // Validate that a string is exactly 12 characters long...
            'title' => 'size:12';
            
            // Validate that a provided integer equals 10...
            'seats' => 'integer|size:10';
            
            // Validate that an array has exactly 5 elements...
            'tags' => 'array|size:5';
            
            // Validate that an uploaded file is exactly 512 kilobytes...
            'image' => 'file|size:512';
      
     
    
34. string
                The field under validation must be a string. If you would like to allow the field to 
                also be null, you should assign the nullable rule to the field.


35. timezone
        The field under validation must be a valid timezone identifier according to 
        the timezone_identifiers_list PHP function.
        
36. unique:table,column,except,idColumn

    The field under validation must not exist within the given database table.
    
    Specifying A Custom Table / Column Name:
    
    Instead of specifying the table name directly, you may specify the Eloquent model which should be used to determine the table name:
    
    'email' => 'unique:App\User,email_address'
    The column option may be used to specify the field's corresponding database column. If the column option is not specified, the field name will be used.
    
    'email' => 'unique:users,email_address'
        
        



