<?php


// Image Function
// Image Function
// Image Function
public function user_update($id, Request $request)
    {
        $updateUser = User::getSingle($id);
        $updateUser->name = trim($request->name);
        $updateUser->email = trim($request->email);
        $updateUser->isRole = trim($request->isRole); 
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if(!empty($request->file('image'))){
            if(!empty($updateUser->image) && file_exists('public/images/users/'.$updateUser->image))
            {
                unlink('public/images/users/'.$updateUser->image);
            }
            $file       = $request->file('image');
            $randomStr  = Str::random(10);
            $filename   = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('public/images/users', $filename);
            $updateUser->image = $filename; 
        }
        $updateUser->save();
        return redirect(url('admin/users'))->with('success', 'User hasbeen Updated Succssfully');
    }



// Show Image in List Table
// Show Image in List Table
// Show Image in List Table
    <div class="table-responsive">          
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-wrap: nowrap;">Id</th>
                <th style="text-wrap: nowrap;">Image</th>
                <th style="text-wrap: nowrap;">Username</th>
                <th style="text-wrap: nowrap;">Email</th>
                <th style="text-wrap: nowrap;">Role</th>
                <th style="text-wrap: nowrap;">Create-Date</th>
                <th style="text-wrap: nowrap;">Edit</th>
                <th style="text-wrap: nowrap;">SoftDelete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($getAdmin as $value)
            <tr>
                <td style="text-wrap: nowrap;">{{ $value->id }}
            </td>
            <td>
                @if(!empty($value->image))
                    <img src="{{ url('public/images/users/'.$value->image) }}" style="height: 30px; width: 30px; object-fit: cover; border-radius: 50px;"> 
                @endif
            </td>
            <td style="text-wrap: nowrap;">{{ $value->name }}</td>
            <td style="text-wrap: nowrap;">{{ $value->email }}</td>
            <td style="text-wrap: nowrap;">{{ $value->isRole == 1 ? 'Admin' : 'Register' }}</td>
            <td style="text-wrap: nowrap;">{{ date('d-m-y'), strtotime($value->created_at) }}</td>
            <td style="text-wrap: nowrap;"><a href="{{ url('admin/user/edit/'.$value->id) }}" class="btn btn-primary text-white"><i class="bi bi-pencil-square"></i></a></td>
            <td style="text-wrap: nowrap;"><a href="{{ url('admin/user/softdelete/'.$value->id) }}" class="btn btn-warning text-white" onclick="return confirm('Are you sure you want to trash this item?');"><i class="bi bi-trash-fill"></i></a></td>
            </tr>
            @endforeach

        </tbody>
        </table>
    </div>



// Show Image in edit/update Page
// Show Image in edit/update Page
// Show Image in edit/update Page
    <div class="form-group row mb-3">
        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload <span style="color: red;">*</span></label>
        <div class="col-sm-10">
        <input class="form-control" type="file" name="image">
        @if($getRecord->image)
            <img width="100" height="100" src="{{ url('public/images/users/'.$getRecord->image) }}">
        @endif
        </div>
    </div>

        
// Model Image function
// Model Image function
// Model Image function
     public function getImage()
        {
            if(!empty($this->image) && file_exists('public/images/blog/'.$this->image)) 
            {
                return url('public/images/blog/'.$this->image);
            }
            else 
            {
                return "";
            }
        }



?>
