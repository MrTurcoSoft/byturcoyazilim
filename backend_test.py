#!/usr/bin/env python3
"""
Laravel Web Agency Backend API Testing
Tests all public routes, forms, and admin functionality
"""

import requests
import sys
import json
from datetime import datetime

class LaravelAPITester:
    def __init__(self, base_url="https://c07e54b5-57de-417e-b09e-48517278f24a.preview.emergentagent.com"):
        self.base_url = base_url
        self.session = requests.Session()
        self.tests_run = 0
        self.tests_passed = 0
        self.csrf_token = None
        self.admin_logged_in = False

    def run_test(self, name, method, endpoint, expected_status, data=None, headers=None, follow_redirects=True):
        """Run a single test"""
        url = f"{self.base_url}/{endpoint.lstrip('/')}"
        
        self.tests_run += 1
        print(f"\n🔍 Testing {name}...")
        print(f"   URL: {url}")
        
        try:
            if headers is None:
                headers = {}
            
            # Add CSRF token if available
            if self.csrf_token and method in ['POST', 'PUT', 'PATCH', 'DELETE']:
                if data is None:
                    data = {}
                data['_token'] = self.csrf_token
                headers['X-CSRF-TOKEN'] = self.csrf_token
            
            if method == 'GET':
                response = self.session.get(url, headers=headers, allow_redirects=follow_redirects)
            elif method == 'POST':
                response = self.session.post(url, data=data, headers=headers, allow_redirects=follow_redirects)
            elif method == 'PUT':
                response = self.session.put(url, data=data, headers=headers, allow_redirects=follow_redirects)
            elif method == 'PATCH':
                response = self.session.patch(url, data=data, headers=headers, allow_redirects=follow_redirects)
            elif method == 'DELETE':
                response = self.session.delete(url, headers=headers, allow_redirects=follow_redirects)

            success = response.status_code == expected_status
            if success:
                self.tests_passed += 1
                print(f"✅ Passed - Status: {response.status_code}")
            else:
                print(f"❌ Failed - Expected {expected_status}, got {response.status_code}")
                if response.status_code >= 400:
                    print(f"   Response: {response.text[:200]}...")

            return success, response

        except Exception as e:
            print(f"❌ Failed - Error: {str(e)}")
            return False, None

    def extract_csrf_token(self, response):
        """Extract CSRF token from response"""
        import re
        try:
            if 'csrf-token' in response.text:
                match = re.search(r'name="csrf-token" content="([^"]+)"', response.text)
                if match:
                    self.csrf_token = match.group(1)
                    print(f"   CSRF token extracted: {self.csrf_token[:20]}...")
                    return True
            
            # Try to find _token in forms
            match = re.search(r'name="_token" value="([^"]+)"', response.text)
            if match:
                self.csrf_token = match.group(1)
                print(f"   CSRF token extracted from form: {self.csrf_token[:20]}...")
                return True
                
        except Exception as e:
            print(f"   Could not extract CSRF token: {e}")
        return False

    def test_homepage(self):
        """Test homepage loads with hero section and services"""
        success, response = self.run_test("Homepage", "GET", "/", 200)
        if success and response:
            self.extract_csrf_token(response)
            # Check for key elements
            content = response.text.lower()
            if 'digiagency' in content or 'web tasarım' in content:
                print("   ✅ Homepage content looks good")
                return True
            else:
                print("   ⚠️ Homepage content may be missing")
        return success

    def test_services_page(self):
        """Test services page shows all services"""
        success, response = self.run_test("Services Page", "GET", "/hizmetler", 200)
        if success and response:
            content = response.text.lower()
            if 'web tasarım' in content or 'web yazılım' in content:
                print("   ✅ Services page content looks good")
                return True
            else:
                print("   ⚠️ Services page content may be missing")
        return success

    def test_references_page(self):
        """Test references page shows portfolio items"""
        success, response = self.run_test("References Page", "GET", "/referanslar", 200)
        if success and response:
            content = response.text.lower()
            if 'e-ticaret' in content or 'kurumsal' in content or 'portfolio' in content:
                print("   ✅ References page content looks good")
                return True
            else:
                print("   ⚠️ References page content may be missing")
        return success

    def test_contact_page(self):
        """Test contact page loads"""
        success, response = self.run_test("Contact Page", "GET", "/iletisim", 200)
        if success and response:
            self.extract_csrf_token(response)
            content = response.text.lower()
            if 'iletişim' in content or 'contact' in content:
                print("   ✅ Contact page content looks good")
                return True
        return success

    def test_quote_page(self):
        """Test quote page loads"""
        success, response = self.run_test("Quote Page", "GET", "/teklif-al", 200)
        if success and response:
            self.extract_csrf_token(response)
            content = response.text.lower()
            if 'teklif' in content or 'quote' in content:
                print("   ✅ Quote page content looks good")
                return True
        return success

    def test_contact_form_submission(self):
        """Test contact form submission"""
        if not self.csrf_token:
            print("   ⚠️ No CSRF token available, skipping form test")
            return False
            
        contact_data = {
            'name': 'Test User',
            'email': 'test@example.com',
            'phone': '+90 555 123 4567',
            'company': 'Test Company',
            'subject': 'Test Subject',
            'message': 'This is a test message for contact form.',
            '_token': self.csrf_token
        }
        
        success, response = self.run_test("Contact Form Submission", "POST", "/iletisim", 302, contact_data)
        if success:
            print("   ✅ Contact form submitted successfully")
        return success

    def test_quote_form_submission(self):
        """Test quote form submission"""
        if not self.csrf_token:
            print("   ⚠️ No CSRF token available, skipping form test")
            return False
            
        quote_data = {
            'name': 'Test User',
            'email': 'test@example.com',
            'phone': '+90 555 123 4567',
            'company': 'Test Company',
            'project_type': 'Web Tasarım',
            'project_description': 'Test project description for quote form.',
            'budget_range': '10000-25000',
            'timeline': '2-3 ay',
            'preferred_date': '2024-12-25',
            'preferred_time': '14:00',
            '_token': self.csrf_token
        }
        
        success, response = self.run_test("Quote Form Submission", "POST", "/teklif-al", 302, quote_data)
        if success:
            print("   ✅ Quote form submitted successfully")
        return success

    def test_language_switcher(self):
        """Test language switcher functionality"""
        # Test Turkish
        success_tr, _ = self.run_test("Language Switch to TR", "GET", "/lang/tr", 302)
        
        # Test English
        success_en, _ = self.run_test("Language Switch to EN", "GET", "/lang/en", 302)
        
        return success_tr and success_en

    def test_admin_login_page(self):
        """Test admin login page loads"""
        success, response = self.run_test("Admin Login Page", "GET", "/login", 200)
        if success and response:
            self.extract_csrf_token(response)
            content = response.text.lower()
            if 'login' in content or 'giriş' in content:
                print("   ✅ Admin login page content looks good")
                return True
        return success

    def test_admin_login(self):
        """Test admin login with credentials"""
        if not self.csrf_token:
            print("   ⚠️ No CSRF token available, skipping login test")
            return False
            
        login_data = {
            'email': 'admin@admin.com',
            'password': 'admin123',
            '_token': self.csrf_token
        }
        
        success, response = self.run_test("Admin Login", "POST", "/login", 302, login_data)
        if success:
            self.admin_logged_in = True
            print("   ✅ Admin login successful")
        return success

    def test_admin_dashboard(self):
        """Test admin dashboard shows statistics"""
        if not self.admin_logged_in:
            print("   ⚠️ Admin not logged in, skipping dashboard test")
            return False
            
        success, response = self.run_test("Admin Dashboard", "GET", "/admin", 200)
        if success and response:
            content = response.text.lower()
            if 'dashboard' in content or 'istatistik' in content or 'contact' in content:
                print("   ✅ Admin dashboard content looks good")
                return True
        return success

    def test_admin_services_page(self):
        """Test admin services CRUD page"""
        if not self.admin_logged_in:
            print("   ⚠️ Admin not logged in, skipping services test")
            return False
            
        success, response = self.run_test("Admin Services Page", "GET", "/admin/services", 200)
        if success and response:
            content = response.text.lower()
            if 'service' in content or 'hizmet' in content:
                print("   ✅ Admin services page content looks good")
                return True
        return success

    def test_admin_settings_page(self):
        """Test admin settings page"""
        if not self.admin_logged_in:
            print("   ⚠️ Admin not logged in, skipping settings test")
            return False
            
        success, response = self.run_test("Admin Settings Page", "GET", "/admin/settings", 200)
        if success and response:
            content = response.text.lower()
            if 'setting' in content or 'ayar' in content:
                print("   ✅ Admin settings page content looks good")
                return True
        return success

    def test_about_page(self):
        """Test about page"""
        success, response = self.run_test("About Page", "GET", "/hakkimizda", 200)
        return success

    def test_blog_page(self):
        """Test blog page"""
        success, response = self.run_test("Blog Page", "GET", "/blog", 200)
        return success

def main():
    print("🚀 Starting Laravel Web Agency Backend Tests")
    print("=" * 60)
    
    tester = LaravelAPITester()
    
    # Test public pages
    print("\n📄 Testing Public Pages...")
    tester.test_homepage()
    tester.test_about_page()
    tester.test_services_page()
    tester.test_references_page()
    tester.test_contact_page()
    tester.test_quote_page()
    tester.test_blog_page()
    
    # Test language switcher
    print("\n🌐 Testing Language Switcher...")
    tester.test_language_switcher()
    
    # Test form submissions
    print("\n📝 Testing Form Submissions...")
    tester.test_contact_form_submission()
    tester.test_quote_form_submission()
    
    # Test admin functionality
    print("\n🔐 Testing Admin Functionality...")
    tester.test_admin_login_page()
    tester.test_admin_login()
    tester.test_admin_dashboard()
    tester.test_admin_services_page()
    tester.test_admin_settings_page()
    
    # Print results
    print("\n" + "=" * 60)
    print(f"📊 Test Results: {tester.tests_passed}/{tester.tests_run} tests passed")
    success_rate = (tester.tests_passed / tester.tests_run * 100) if tester.tests_run > 0 else 0
    print(f"📈 Success Rate: {success_rate:.1f}%")
    
    if success_rate >= 80:
        print("✅ Backend tests mostly successful!")
        return 0
    else:
        print("❌ Backend tests have significant issues!")
        return 1

if __name__ == "__main__":
    sys.exit(main())