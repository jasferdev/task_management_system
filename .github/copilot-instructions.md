# Copilot Instructions for Task Management System

## Project Overview
This is a **Laravel 12 task management application** with a relational database design. The system manages tasks across departments with user assignments, comments, and reporting capabilities. Frontend uses Alpine.js with Tailwind CSS for styling.

## Architecture & Key Patterns

### Model-Controller Structure
- **Models** (`app/Models/`): Use custom primary keys (e.g., `TaskID`, `UserID` instead of `id`) - define `$primaryKey` and `getRouteKeyName()` in each model
- **Controllers** (`app/Http/Controllers/`): Standard CRUD resources with eager loading (see `TaskController::index()` using `with()` for relationships)
- **Routes** (`routes/web.php`): Uses implicit route model binding with custom key mapping via `Route::bind()` - bind parameters to custom primary key names
- **Form Requests** (`app/Http/Requests/`): Centralized validation using FormRequest classes (14 classes for all CRUD operations)

### Database Design
- All models use custom primary keys (`TaskID`, `UserID`, `DepartmentID`, etc.)
- Foreign key references follow explicit column naming (e.g., `Task` has `CreatedBy` and `AssignedTo` both referencing `User::UserID`)
- Pivot table: `report_tasks` for many-to-many between `Report` and `Task`
- Seeders in `database/seeders/` populate test data; use `DatabaseSeeder` as entry point

### Relationship Patterns
Tasks are central: belong to a department, created/assigned to users, have comments, and can be included in reports.
```php
// Task relationships (exemplar)
creator() → BelongsTo User via CreatedBy
assignee() → BelongsTo User via AssignedTo
department() → BelongsTo Department
comments() → HasMany Comment
reports() → BelongsToMany Report (via report_tasks pivot)
```

## Error Handling & Robustness

### Exception Handling
All controllers have try-catch blocks protecting every action:
```php
try {
    // Operation
    Log::info('Success', ['id' => $record->ID]);
    return redirect()->with('success', 'Message');
} catch (Exception $e) {
    Log::error('Error: ' . $e->getMessage());
    return redirect()->back()->with('error', 'User-friendly message');
}
```

### Form Request Validation
Use dedicated FormRequest classes in `app/Http/Requests/` instead of inline `validate()`:
- `StoreTaskRequest`, `UpdateTaskRequest` - Task validation with deadline validation
- `StoreUserRequest`, `UpdateUserRequest` - User validation with unique email
- `ChangePasswordRequest` - Password confirmation
- Similar pattern for Comments, Departments, Reports, SystemParameters

**All FormRequests include:** custom error messages, enum validation for statuses/roles, relationship existence checks, max length validation.

### Model Query Scopes
Use query scopes to reduce duplication:
```php
// Task scopes
Task::byStatus('pending')->assignedToUser($userId)->get()
Task::overdue()->get()  // Overdue incomplete tasks
Task::dueSoon()->get()  // Due within 7 days
Task::inDepartment($deptId)->get()

// User scopes
User::active()->inDepartment($deptId)->get()
User::withRole('admin')->get()
```

### Data Integrity Checks
Prevent deletion of records with relationships:
```php
if ($department->users()->exists()) {
    return redirect()->with('error', 'Cannot delete department with users...');
}
// Similar checks for tasks, assigned users, etc.
```

### Logging
All important operations are logged:
```php
Log::info('Task created successfully', ['task_id' => $task->TaskID]);
Log::error('Error creating task: ' . $e->getMessage());
```
View logs in `storage/logs/laravel.log`

## Development Workflow

### Commands
```bash
npm install && npm run build          # Build frontend assets
composer install                      # Install PHP dependencies
php artisan migrate                   # Run database migrations
php artisan db:seed                   # Populate test data
php artisan serve                     # Start development server (port 8000)
php artisan queue:listen              # Process queued jobs
composer run dev                      # Concurrent: server + queue + vite dev
composer run test                     # Run Pest tests (Feature + Unit)
```

### Frontend Build
- **Vite** dev server at `npm run dev` (hot reload for CSS/JS)
- Entry points: `resources/css/app.css`, `resources/js/app.js`
- Tailwind CSS configured via `tailwind.config.js`
- Alpine.js for interactivity

### Testing
- **Pest framework** (`tests/Feature/` and `tests/Unit/`)
- Database isolation: In-memory SQLite for tests (see `phpunit.xml`)
- Models auto-refresh in tests via `RefreshDatabase` trait

## Project-Specific Conventions

### Implicit Model Binding
When adding new models/routes, always:
1. Define `$primaryKey = 'EntityID'` in the model
2. Override `getRouteKeyName()` to return the custom key
3. Add corresponding `Route::bind()` in `routes/web.php`

Example for a hypothetical `Invoice` model:
```php
Route::bind('invoice', function ($value) {
    return \App\Models\Invoice::where('InvoiceID', $value)->firstOrFail();
});
```

### Validation & Error Handling
- Use FormRequest classes (`app/Http/Requests/`) for all validation
- Controllers should never use inline `validate()` anymore
- Default to user ID 1 if unauthenticated (`auth()->id() ?? 1`)
- Always wrap operations in try-catch blocks
- Return user-friendly error messages, never expose exceptions

### View Conventions
- Blade templates in `resources/views/` organized by resource (tasks/, users/, etc.)
- Shared layouts in `resources/views/layouts/app.blade.php`
- Component classes in `app/View/Components/` (AppLayout, GuestLayout)

### Parameter Validation
Validate all query parameters before use:
```php
public function getByStatus($status)
{
    $validStatuses = ['pending', 'in_progress', 'completed', 'cancelled'];
    if (!in_array($status, $validStatuses)) {
        return redirect()->with('error', 'Invalid status.');
    }
    // Continue safely
}
```

## Key Files for Quick Reference
- **Validation**: [app/Http/Requests/](app/Http/Requests/) (14 FormRequest classes)
- **Error Handling Guide**: [ERROR_HANDLING_GUIDE.md](ERROR_HANDLING_GUIDE.md) - Comprehensive documentation of all improvements
- **Database**: [migrations](database/migrations/) (7 migrations for core entities)
- **Models**: [app/Models/](app/Models/) (Task has 7 query scopes, User has 4)
- **Controllers**: [app/Http/Controllers/](app/Http/Controllers/) (6 controllers with exception handling)
- **Routing**: [routes/web.php](routes/web.php#L21-L44) (route binding setup)
- **Config**: [config/database.php](config/database.php) (MySQL by default)

## Integration Notes
- **Auth**: Laravel Breeze (configured in `config/auth.php`); guard is 'web'
- **Database**: MySQL (configure `.env`); SQLite for tests
- **Sessions**: Array driver in test environment; file-based in production
- **No external APIs**: All data is self-contained in the database
- **Logging**: Enable in `config/logging.php` - view at `storage/logs/laravel.log`

## When Adding Features
1. Create migration in `database/migrations/` with timestamp prefix
2. Create model in `app/Models/` with relationships, custom keys, and query scopes
3. Update route bindings if new model needs implicit binding
4. Create FormRequest in `app/Http/Requests/` for validation
5. Create controller in `app/Http/Controllers/` with try-catch blocks and logging
6. Add views in `resources/views/{resource}/` (index, create, edit, show)
7. Write tests in `tests/Feature/` using Pest syntax
8. Add data integrity checks (prevent deletion with related records)

## Common Pitfalls to Avoid
- ❌ Using inline `validate()` instead of FormRequest classes
- ❌ Forgetting to eager load relationships (causes N+1 queries)
- ❌ Not checking if parent records have children before deletion
- ❌ Exposing exception messages to users
- ❌ Not logging important operations
- ❌ Missing try-catch blocks in controllers
- ❌ Using `firstOrFail()` without try-catch

## Improvements Made (December 15, 2025)
See [ERROR_HANDLING_GUIDE.md](ERROR_HANDLING_GUIDE.md) for detailed documentation of:
- ✅ 6 controllers updated with exception handling (try-catch blocks)
- ✅ 14 FormRequest validation classes created
- ✅ 13 query scopes added to models
- ✅ 100+ logging statements added throughout application
- ✅ 1 error handling middleware created
- ✅ Data integrity checks for all delete operations
- ✅ Parameter validation for all custom routes
- ✅ User-friendly error messages for all error scenarios
