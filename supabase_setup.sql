-- ============================================================================
-- Esa Corner (Sistem Pemesanan Makanan Kantin Kampus - Ebisnis)
-- Complete PostgreSQL Schema & Seed Script for Supabase
-- Run this once in Supabase Dashboard -> SQL Editor -> New Query -> Run
-- ============================================================================

BEGIN;

-- 1. Laravel Migrations Tracking Table
CREATE TABLE IF NOT EXISTS public.migrations (
    id SERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INTEGER NOT NULL
);

-- 2. Outlets Table
CREATE TABLE IF NOT EXISTS public.outlets (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    image VARCHAR(255),
    description TEXT,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);

-- 3. Users, Password Reset Tokens & Sessions Tables
CREATE TABLE IF NOT EXISTS public.users (
    id BIGSERIAL PRIMARY KEY,
    outlet_id BIGINT REFERENCES public.outlets(id) ON DELETE SET NULL,
    avatar_url VARCHAR(255),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP(0) WITHOUT TIME ZONE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100),
    theme VARCHAR(255) DEFAULT 'sunset',
    theme_color VARCHAR(255),
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);

CREATE TABLE IF NOT EXISTS public.password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE
);

CREATE TABLE IF NOT EXISTS public.sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);
CREATE INDEX IF NOT EXISTS sessions_user_id_index ON public.sessions (user_id);
CREATE INDEX IF NOT EXISTS sessions_last_activity_index ON public.sessions (last_activity);

-- 4. Cache Tables
CREATE TABLE IF NOT EXISTS public.cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS public.cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INTEGER NOT NULL
);

-- 5. Jobs Tables
CREATE TABLE IF NOT EXISTS public.jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INTEGER,
    available_at INTEGER NOT NULL,
    created_at INTEGER NOT NULL
);
CREATE INDEX IF NOT EXISTS jobs_queue_index ON public.jobs (queue);

CREATE TABLE IF NOT EXISTS public.job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT,
    cancelled_at INTEGER,
    created_at INTEGER NOT NULL,
    finished_at INTEGER
);

CREATE TABLE IF NOT EXISTS public.failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 6. Spatie Permission Tables
CREATE TABLE IF NOT EXISTS public.permissions (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE,
    CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name)
);

CREATE TABLE IF NOT EXISTS public.roles (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE,
    CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name)
);

CREATE TABLE IF NOT EXISTS public.model_has_permissions (
    permission_id BIGINT NOT NULL REFERENCES public.permissions(id) ON DELETE CASCADE,
    model_type VARCHAR(255) NOT NULL,
    model_id BIGINT NOT NULL,
    CONSTRAINT model_has_permissions_permission_model_type_primary PRIMARY KEY (permission_id, model_id, model_type)
);
CREATE INDEX IF NOT EXISTS model_has_permissions_model_id_model_type_index ON public.model_has_permissions (model_id, model_type);

CREATE TABLE IF NOT EXISTS public.model_has_roles (
    role_id BIGINT NOT NULL REFERENCES public.roles(id) ON DELETE CASCADE,
    model_type VARCHAR(255) NOT NULL,
    model_id BIGINT NOT NULL,
    CONSTRAINT model_has_roles_role_model_type_primary PRIMARY KEY (role_id, model_id, model_type)
);
CREATE INDEX IF NOT EXISTS model_has_roles_model_id_model_type_index ON public.model_has_roles (model_id, model_type);

CREATE TABLE IF NOT EXISTS public.role_has_permissions (
    permission_id BIGINT NOT NULL REFERENCES public.permissions(id) ON DELETE CASCADE,
    role_id BIGINT NOT NULL REFERENCES public.roles(id) ON DELETE CASCADE,
    CONSTRAINT role_has_permissions_permission_id_role_id_primary PRIMARY KEY (permission_id, role_id)
);

-- 7. Spatie Activity Log Table
CREATE TABLE IF NOT EXISTS public.activity_log (
    id BIGSERIAL PRIMARY KEY,
    log_name VARCHAR(255),
    description TEXT NOT NULL,
    subject_type VARCHAR(255),
    subject_id BIGINT,
    event VARCHAR(255),
    causer_type VARCHAR(255),
    causer_id BIGINT,
    properties JSON,
    batch_uuid UUID,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);
CREATE INDEX IF NOT EXISTS activity_log_log_name_index ON public.activity_log (log_name);
CREATE INDEX IF NOT EXISTS subject ON public.activity_log (subject_type, subject_id);
CREATE INDEX IF NOT EXISTS causer ON public.activity_log (causer_type, causer_id);

-- 8. Menus Table
CREATE TABLE IF NOT EXISTS public.menus (
    id BIGSERIAL PRIMARY KEY,
    outlet_id BIGINT NOT NULL REFERENCES public.outlets(id) ON DELETE CASCADE,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL DEFAULT 'makanan',
    image VARCHAR(255),
    description TEXT,
    price INTEGER NOT NULL,
    is_available BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);

-- 9. Orders Table
CREATE TABLE IF NOT EXISTS public.orders (
    id BIGSERIAL PRIMARY KEY,
    outlet_id BIGINT NOT NULL REFERENCES public.outlets(id) ON DELETE CASCADE,
    order_code VARCHAR(255) NOT NULL UNIQUE,
    order_type VARCHAR(255) NOT NULL DEFAULT 'solo' CHECK (order_type IN ('solo', 'group')),
    service_type VARCHAR(255) NOT NULL DEFAULT 'dine_in' CHECK (service_type IN ('dine_in', 'take_away')),
    total_price INTEGER NOT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'pending' CHECK (status IN ('pending', 'paid', 'cooking', 'ready', 'completed')),
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);

-- 10. Order Items Table
CREATE TABLE IF NOT EXISTS public.order_items (
    id BIGSERIAL PRIMARY KEY,
    order_id BIGINT NOT NULL REFERENCES public.orders(id) ON DELETE CASCADE,
    menu_id BIGINT NOT NULL REFERENCES public.menus(id) ON DELETE CASCADE,
    customer_name VARCHAR(255) NOT NULL,
    quantity INTEGER NOT NULL,
    price INTEGER NOT NULL,
    subtotal INTEGER NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE
);

-- ============================================================================
-- SEED DATA (Roles, Permissions, Outlets, Menus, Users, Migrations)
-- ============================================================================

-- Record Laravel migrations as executed
INSERT INTO public.migrations (migration, batch)
SELECT m.migration, 1
FROM (VALUES
    ('0001_01_01_000000_create_users_table'),
    ('0001_01_01_000001_create_cache_table'),
    ('0001_01_01_000002_create_jobs_table'),
    ('2025_04_12_082932_create_permission_tables'),
    ('2025_04_12_083218_create_activity_log_table'),
    ('2025_04_12_083219_add_event_column_to_activity_log_table'),
    ('2025_04_12_083220_add_batch_uuid_column_to_activity_log_table'),
    ('2025_04_12_083341_add_themes_settings_to_users_table'),
    ('2026_10_08_220516_create_outlets_table'),
    ('2026_10_08_220525_create_menus_table'),
    ('2026_10_08_220530_create_orders_table'),
    ('2026_10_08_220536_create_order_items_table'),
    ('2026_10_18_223800_add_outlet_id_to_users_table'),
    ('2026_11_25_100000_add_category_to_menus_table')
) AS m(migration)
WHERE NOT EXISTS (
    SELECT 1 FROM public.migrations existing WHERE existing.migration = m.migration
);

-- Roles
INSERT INTO public.roles (name, guard_name, created_at, updated_at)
VALUES
    ('super_admin', 'web', NOW(), NOW()),
    ('user', 'web', NOW(), NOW())
ON CONFLICT (name, guard_name) DO NOTHING;

-- Permissions for Outlet Admins
INSERT INTO public.permissions (name, guard_name, created_at, updated_at)
VALUES
    ('view_any_menu', 'web', NOW(), NOW()),
    ('view_menu', 'web', NOW(), NOW()),
    ('create_menu', 'web', NOW(), NOW()),
    ('update_menu', 'web', NOW(), NOW()),
    ('delete_menu', 'web', NOW(), NOW()),
    ('delete_any_menu', 'web', NOW(), NOW()),
    ('view_any_order', 'web', NOW(), NOW()),
    ('view_order', 'web', NOW(), NOW()),
    ('update_order', 'web', NOW(), NOW()),
    ('view_any_order::item', 'web', NOW(), NOW()),
    ('view_order::item', 'web', NOW(), NOW()),
    ('update_order::item', 'web', NOW(), NOW()),
    ('view_any_outlet', 'web', NOW(), NOW()),
    ('view_outlet', 'web', NOW(), NOW()),
    ('update_outlet', 'web', NOW(), NOW())
ON CONFLICT (name, guard_name) DO NOTHING;

-- Attach outlet permissions to 'user' role
INSERT INTO public.role_has_permissions (permission_id, role_id)
SELECT p.id, r.id
FROM public.permissions p
JOIN public.roles r ON r.name = 'user' AND r.guard_name = 'web'
WHERE p.guard_name = 'web'
ON CONFLICT DO NOTHING;

-- Outlets (IDs 1..4)
INSERT INTO public.outlets (id, name, slug, description, is_active, created_at, updated_at)
VALUES
    (1, 'Esa Corner', 'esa-corner', 'Pusat jajanan burger, ayam krispi, camilan dan es kopi kekinian', TRUE, NOW(), NOW()),
    (2, 'Kantin Mamici', 'kantin-mamici', 'Spesialis baso aci, baso urat, mie ayam gurih, dan aneka jajanan lezat', TRUE, NOW(), NOW()),
    (3, 'Kantin Teh Nur', 'kantin-teh-nur', 'Menu ayam cabe hijau, ayam bawang putih mantap, aneka gorengan, dan jus segar', TRUE, NOW(), NOW()),
    (4, 'Kedai Bu Yanti', 'kedai-bu-yanti', 'Aneka nasi goreng, kwetiau, mie goreng & rebus lezat resep khas Bu Yanti', TRUE, NOW(), NOW())
ON CONFLICT (id) DO UPDATE SET
    name = EXCLUDED.name,
    slug = EXCLUDED.slug,
    description = EXCLUDED.description,
    is_active = EXCLUDED.is_active,
    updated_at = NOW();

-- Menus (23 items across 4 outlets; idempotent if menus table is empty)
INSERT INTO public.menus (outlet_id, name, category, image, description, price, is_available, created_at, updated_at)
SELECT v.outlet_id, v.name, v.category, v.image, v.description, v.price, v.is_available, NOW(), NOW()
FROM (VALUES
    (1, 'Ayam Geprek', 'makanan', 'menus/ayam-geprek.jpg', 'Ayam krispi gurih digeprek dengan sambal cabai rawit pedas nikmat khas Esa Corner.', 16000, TRUE),
    (1, 'Ayam Popcorn', 'cemilan', 'menus/ayam-popcorn.jpg', 'Potongan ayam renyah empuk dibalut tepung bumbu gurih yang renyah nagih.', 14000, TRUE),
    (1, 'Burger', 'makanan', 'menus/burger.jpg', 'Burger lezat dengan patty daging gurih, selada segar, keju dan saus racikan spesial.', 15000, TRUE),
    (1, 'Es Kopi', 'minuman', 'menus/es-kopi.jpg', 'Kopi susu dingin segar beraroma harum penambah semangat saat jeda kuliah.', 8000, TRUE),
    (1, 'Es Krim', 'cemilan', 'menus/es-krim.jpg', 'Es krim manis lembut dingin yang memanjakan lidah di siang hari.', 7000, TRUE),
    (1, 'Kentang Goreng', 'cemilan', 'menus/kentang-goreng.jpg', 'French fries renyah keemasan bertabur gurih bumbu ditemani cocolan saus.', 10000, TRUE),
    (2, 'Cimol', 'cemilan', 'menus/cimol.jpg', 'Cimol bulat kenyal hangat bertabur bumbu asin gurih pedas khas Mamici.', 10000, TRUE),
    (2, 'Otak Otak', 'cemilan', 'menus/otak-otak.jpg', 'Otak-otak ikan goreng gurih mekar dengan saus cocolan sedap.', 10000, TRUE),
    (2, 'Baso Aci', 'makanan', 'menus/baso-aci.jpg', 'Baso aci kenyal isi dengan kuah pedas gurih segar perasan jeruk limau.', 12000, TRUE),
    (2, 'Mie Ayam', 'makanan', 'menus/mie-ayam.jpg', 'Mie kenyal dengan potongan ayam semur gurih manis lengkap dengan sawi segar.', 13000, TRUE),
    (2, 'Baso Urat', 'makanan', 'menus/baso-urat.jpeg', 'Bakso urat sapi asli kenyal berdaging dengan kuah kaldu sapi gurih mantap.', 18000, TRUE),
    (2, 'Air Mineral', 'minuman', 'menus/air-mineral.jpg', 'Air mineral botol dingin pelepas dahaga yang higienis dan segar.', 4000, TRUE),
    (3, 'Ayam Bawang Putih', 'makanan', 'menus/ayam-bawang-putih.jpg', 'Ayam goreng wangi bawang putih meresap dengan tekstur renyah dan gurih sedap.', 15000, TRUE),
    (3, 'Ayam Cabe Hijau', 'makanan', 'menus/ayam-cabe-hijau.jpg', 'Ayam empuk gurih dengan siraman ulekan sambal cabe hijau pedas segar.', 15000, TRUE),
    (3, 'Gorengan', 'cemilan', 'menus/gorengan.jpg', 'Aneka gorengan hangat renyah garing teman santai paling pas.', 5000, TRUE),
    (3, 'Teh Pucuk', 'minuman', 'menus/teh-pucuk.jpg', 'Teh melati manis kemasan dingin menyegarkan.', 5000, TRUE),
    (3, 'Pop Mie', 'makanan', 'menus/pop-mie.jpg', 'Mie kuah instan hangat gurih yang pas disantap cepat di sela kuliah.', 8000, TRUE),
    (3, 'Jus Buah', 'minuman', 'menus/jus-buah.jpg', 'Jus buah segar manis dingin kaya vitamin penyejuk suasana.', 8000, TRUE),
    (4, 'Nasi Goreng', 'makanan', 'menus/nasi-goreng.jpg', 'Nasi goreng harum rempah komplit dengan telur mata sapi dan kerupuk renyah.', 15000, TRUE),
    (4, 'Kwetiau Goreng', 'makanan', 'menus/kwetiau-goreng.jpg', 'Kwetiau goreng kenyal gurih dengan bumbu meresap, telur dan sayuran segar.', 15000, TRUE),
    (4, 'Mie Goreng', 'makanan', 'menus/mie-goreng.jpg', 'Mie goreng lezat gurih manis dengan telur orak-arik dan taburan bawang goreng.', 13000, TRUE),
    (4, 'Mie Rebus', 'makanan', 'menus/mie-rebus.jpg', 'Mie rebus kuah hangat gurih kaldu dengan telur dan sawi hijau segar.', 13000, TRUE),
    (4, 'Kopi', 'minuman', 'menus/kopi.jpg', 'Kopi hangat / dingin mantap aroma nikmat khas racikan Kedai Bu Yanti.', 5000, TRUE)
) AS v(outlet_id, name, category, image, description, price, is_available)
WHERE NOT EXISTS (
    SELECT 1 FROM public.menus existing
    WHERE existing.outlet_id = v.outlet_id AND existing.name = v.name
);

-- Admin Users (default password: "password")
INSERT INTO public.users (outlet_id, name, email, password, theme, created_at, updated_at)
VALUES
    (NULL, 'Super Admin', 'admin@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sunset', NOW(), NOW()),
    (1, 'Admin Esa Corner', 'admin.esacorner@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sunset', NOW(), NOW()),
    (2, 'Admin Kantin Mamici', 'admin.kantinmamici@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sunset', NOW(), NOW()),
    (3, 'Admin Kantin Teh Nur', 'admin.kantintehnur@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sunset', NOW(), NOW()),
    (4, 'Admin Kedai Bu Yanti', 'admin.kedaibuyanti@admin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sunset', NOW(), NOW())
ON CONFLICT (email) DO NOTHING;

-- Assign super_admin role to admin@admin.com
INSERT INTO public.model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\Models\User', u.id
FROM public.roles r
JOIN public.users u ON u.email = 'admin@admin.com'
WHERE r.name = 'super_admin' AND r.guard_name = 'web'
ON CONFLICT DO NOTHING;

-- Assign user role to outlet admins
INSERT INTO public.model_has_roles (role_id, model_type, model_id)
SELECT r.id, 'App\Models\User', u.id
FROM public.roles r
JOIN public.users u ON u.outlet_id IS NOT NULL
WHERE r.name = 'user' AND r.guard_name = 'web'
ON CONFLICT DO NOTHING;

-- Sync PostgreSQL sequences so future inserts never collide
SELECT setval(pg_get_serial_sequence('public.outlets', 'id'), COALESCE((SELECT MAX(id) FROM public.outlets), 1), true);
SELECT setval(pg_get_serial_sequence('public.menus', 'id'), COALESCE((SELECT MAX(id) FROM public.menus), 1), true);
SELECT setval(pg_get_serial_sequence('public.users', 'id'), COALESCE((SELECT MAX(id) FROM public.users), 1), true);
SELECT setval(pg_get_serial_sequence('public.roles', 'id'), COALESCE((SELECT MAX(id) FROM public.roles), 1), true);
SELECT setval(pg_get_serial_sequence('public.permissions', 'id'), COALESCE((SELECT MAX(id) FROM public.permissions), 1), true);

COMMIT;
