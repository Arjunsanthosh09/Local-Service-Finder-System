<!DOCTYPE html>
<html>
<head>
    <title>Test Provider Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Test Provider Registration</div>
                    <div class="card-body">
                        <form action="/test-provider-submit" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Business Name</label>
                                <input type="text" name="business_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Category</label>
                                <select name="service_category_id" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Area</label>
                                <input type="text" name="area" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Base Price</label>
                                <input type="number" name="base_price" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>