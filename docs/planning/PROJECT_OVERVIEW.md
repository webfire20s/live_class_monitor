# Project Overview: Live Class Monitoring System

## Project Summary
The **Live Class Monitoring System** is a centralized web-based platform designed to manage and monitor live class participation across multiple educational institutions (Colleges). It provides a secure way for students to join live YouTube-embedded classes while giving administrators and college officials real-time visibility into attendance and participation.

## Objective
The primary goal of this system is to prevent unauthorized access to live class links and ensure accurate tracking of student attendance (entry and exit times) across 100+ colleges and 2500+ concurrent users, even in shared network environments.

## Scope
- **Multi-tenant Architecture:** Support for multiple colleges with independent student data.
- **Secure Access:** Students must login to access live classes; direct YouTube links are never exposed.
- **Real-time Monitoring:** Real-time dashboard showing active student counts and session logs.
- **Scalability:** Optimized for high concurrency (2500+ students).

## End Users
1. **Super Admin:** WebFire DigiTech / System Owner.
2. **College Admins:** Designated officials at each participating institution.
3. **Students:** Enrolled participants attending the live sessions.

## Business Use Case
Educational organizations often struggle to track actual attendance in live virtual classes when links are shared freely. This system commercializes the "live class" experience by:
- Restricting access to authorized students only.
- Providing colleges with reliable attendance data for compliance and reporting.
- Scaling the monitoring process without manual intervention.

## Application Overview
- **Platform:** Web-based (Mobile, Tablet, Desktop compatible).
- **Tech Stack:** Laravel (Backend), MySQL (Database), YouTube (Video delivery).
- **Core Functionality:** User authentication, Student bulk management, Live Class embedding, Automated session logging.
