@extends('thuan.layouts.app')
@section('content')
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;

        }

        /* Main wrapper */
        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 1200px;
            margin: 0 auto;
            position: relative;
            margin-left: 20px;
        }

        /* Banner row */
        .banner-row {
            width: 100%;
            height: 300px;
            background-color: #f5f5f5;
            position: relative;
        }

        .banner-div {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-container {
            position: absolute;
            bottom: -50px;
            left: 50px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #fff;
            overflow: hidden;
            background-color: #fff;
            z-index: 2;
        }

        .avatar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            position: absolute;
            bottom: -50px;
            left: 170px;
            color: #333;
            z-index: 3;
        }

        .profile-name {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: #333;
        }

        .profile-subtitle {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }



        /* Content row */
        .content-row {
            width: 100%;
            background-color: #fff;
            padding-top: 100px;
            display: flex;
            justify-content: center;
        }

        .content-div {
            width: 1170px;
            margin: 0 auto;
            padding: 0;
        }



        /* Content Layout */
        .content-section {
            display: flex;
            gap: 30px;
            width: 1170px;
            margin: 0 auto;
        }

        /* Column A - Left Side */
        .column-a {
            width: 370px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Column B - Right Side */
        .column-b {
            width: 770px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .section-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: calc(100% - 40px);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        /* Grid for video library */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .grid-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Add button styles if missing */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-primary {
            background-color: #0b83ff;
            color: #fff;
        }










        /* Video Library expand/collapse styles */
        .video-library .image-grid {
            max-height: 340px; /* Height for 2x2 grid */
            overflow: hidden;
            transition: max-height 0.5s ease-out; /* Increased duration for smoother animation */
        }

        .video-library .image-grid.expanded {
            max-height: 1000px;
        }

        .video-library .btn-expand {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 20px 0 0 0;
            background-color: transparent;
            border: 1px solid #0b83ff;
            color: #0b83ff;
        }

        .video-library .btn-expand:hover {
            background-color: #f0f7ff;
        }

        .video-library .btn-expand i {
            transition: transform 0.3s;
        }

        .video-library .btn-expand.expanded i {
            transform: rotate(180deg);
        }


        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .image-caption {
            opacity: 1;
        }

        .image-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .image-actions {
            opacity: 1;
        }

        .image-actions button {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .image-actions button:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .gallery-header {
            display: flex;
            justify-content: flex-end;
            padding: 0 20px;
        }

        .category-section {
            margin-bottom: 40px;
        }

        .category-title {
            padding: 0 20px;
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }

        /* Video Grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .video-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .video-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .video-info {
            padding: 10px;
        }

        .video-info h3 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .video-info p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
        }

        /* Add these timetable styles */
        .timetable-grid {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 0 1px #eee;
        }

        .timetable-header {
            display: grid;
            grid-template-columns: 80px repeat(5, 1fr);
            background: #f8f9fa;
        }

        .timetable-header div {
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
        }

        .timetable-body {
            display: flex;
            flex-direction: column;
        }

        .time-slot {
            display: grid;
            grid-template-columns: 80px repeat(5, 1fr);
        }

        .time-slot div {
            padding: 20px 15px;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
        }

        .time-col {
            text-align: center;
            background: #f8f9fa;
            font-weight: 500;
            color: #666;
        }

        .class-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #fff;
            transition: all 0.3s;
            cursor: pointer;
        }

        .class-item:hover {
            background: #f0f7ff;
        }

        .class-name {
            font-weight: 500;
            color: #333;
            margin-bottom: 4px;
        }

        .class-room {
            font-size: 12px;
            color: #666;
        }

        .empty-slot {
            background: #f9f9f9;
        }

        /* Add styles for material items */
        .material-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .material-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 8px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 12px;
            text-align: center;
        }

        .video-library .image-grid,
        .video-library .hidden-materials {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .material-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            aspect-ratio: 16/9;
        }

        .material-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .material-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 8px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 12px;
            text-align: center;
        }

        .btn-expand {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
            padding: 10px;
            background-color: transparent;
            border: 1px solid #0b83ff;
            color: #0b83ff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-expand:hover {
            background-color: #f0f7ff;
        }

        .btn-expand i {
            transition: transform 0.3s;
        }

        .profile-field {
            margin-bottom: 20px;
        }

        .profile-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .profile-field .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .profile-field .form-input:focus {
            border-color: #0b83ff;
            outline: none;
        }

        .profile-field textarea.form-input {
            resize: vertical;
            min-height: 60px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-info .form-input {
            margin-bottom: 0;
        }



        .bio-form {
            margin-top: 20px;
        }

        /* Cải thiện form styles */
        .details-form {
            padding: 20px 0;
        }

        .details-form .form-group {
            margin-bottom: 25px;
            padding: 0 10px;
        }

        .details-form label {
            font-size: 15px;
            margin-bottom: 10px;
            color: #333;
        }

        .details-form .form-input {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .details-form .form-input:focus {
            border-color: #0b83ff;
            box-shadow: 0 0 0 2px rgba(11, 131, 255, 0.1);
            outline: none;
        }

        .details-form textarea.form-input {
            min-height: 80px;
        }

        .details-form .contact-inputs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        /* Cải thiện modal header */


        /* Cải thiện nút submit */
        .details-form .btn-primary {
            margin: 10px 10px 0;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 600;
            width: calc(100% - 20px);
            transition: all 0.3s;
        }

        .details-form .btn-primary:hover {
            background-color: #0969d7;
            transform: translateY(-1px);
        }

        /* Thêm media query cho màn hình nhỏ */


        .profile-section {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .profile-section:last-child {
            border-bottom: none;
        }

        .section-subtitle {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .profile-text {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        #profileContact p {
            margin: 5px 0;
        }



        .custom-interest-input {
            display: flex;
            gap: 10px;
        }

        .custom-interest-input .form-input {
            flex: 1;
        }





        .gallery-header {
            padding: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item .image-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .image-actions {
            opacity: 1;
        }

        .gallery-item .image-actions button {
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .gallery-item .image-actions button:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .gallery-categories {
            padding: 20px;
        }

        .category-section {
            margin-bottom: 40px;
        }

        .category-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .gallery-item .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .image-caption {
            opacity: 1;
        }



        .video-item video {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }



        .video-item:hover .video-actions {
            opacity: 1;
        }

        .video-actions button {
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .video-actions button:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .transactions-wrapper {
            padding: 20px;
        }

        .transactions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .transactions-header h3 {
            font-size: 20px;
            color: #333;
            margin: 0;
        }

        .transactions-table {
            overflow-x: auto;
        }

        .transactions-table table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .transactions-table th,
        .transactions-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .transactions-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .transactions-table tr:hover {
            background: #f8f9fa;
        }

        .transaction-status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .transaction-amount {
            font-weight: 600;
            color: #28a745;
        }

        .transaction-actions {
            display: flex;
            gap: 5px;
        }

        .transaction-actions button {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-edit {
            background: #ffc107;
            color: #000;
        }

        .btn-delete {
            background: #dc3545;
            color: #fff;
        }

        .transaction-form .form-group {
            margin-bottom: 15px;
        }

        .transaction-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .transaction-form .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .transaction-form select.form-input {
            height: 38px;
        }

        .subscriptions-wrapper {
            padding: 20px;
        }

        .subscriptions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .subscriptions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .subscription-category {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .subscription-category h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .subscription-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .subscription-item {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            position: relative;
        }

        .subscription-item .service-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .subscription-item .service-plan {
            font-size: 14px;
            color: #666;
        }

        .subscription-item .service-dates {
            font-size: 13px;
            color: #888;
            margin-top: 8px;
        }

        .subscription-item .service-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-expired {
            background: #f8d7da;
            color: #721c24;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .date-inputs {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-inputs span {
            color: #666;
        }

        .price-summary {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            margin-top: 20px;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #666;
        }

        .price-item.total {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
            font-weight: 600;
            color: #333;
        }

        .avatar-edit-button {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s;
            border: none;
            width: 100%;
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
        }

        .avatar-container:hover .avatar-edit-button {
            opacity: 1;
        }

        .avatar-edit-button i {
            margin-right: 5px;
        }



        .edit-profile-form .form-group {
            margin-bottom: 15px;
        }

        .edit-profile-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .edit-profile-form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-expand {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
            padding: 10px;
            background-color: transparent;
            border: 1px solid #0b83ff;
            color: #0b83ff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-expand:hover {
            background-color: #f0f7ff;
        }

        .btn-expand i {
            transition: transform 0.3s;
        }

        .btn-expand.expanded i {
            transform: rotate(180deg);
        }

        .hidden-materials {
            display: none;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .materials-footer {
            width: 100%;
        }

        .btn-expand {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            background-color: transparent;
            border: 1px solid #0b83ff;
            color: #0b83ff;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .btn-expand:hover {
            background-color: #f0f7ff;
        }

        .btn-expand i {
            transition: transform 0.3s;
        }

        .btn-expand.expanded i {
            transform: rotate(180deg);
        }

        .hidden-materials {
            display: none;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 15px 0;
        }
    </style>
    <style>
        .items-container {
            transition: max-height 0.3s ease-out;
            overflow: hidden;
        }

        .items-container.collapsed {
            max-height: 0;
        }

        .btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: #f5f5f5;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #e0e0e0;
            transform: translateX(5px);
        }

        .subject-info, .class-info {
            font-size: 0.9em;
            color: #666;
        }

        .expand-btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            background: transparent;
            color: #0b83ff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .expand-btn:hover {
            color: #0969d7;
        }

        .expand-btn i {
            transition: transform 0.3s ease;
        }

        .expand-btn.expanded i {
            transform: rotate(180deg);
        }

        .no-items {
            text-align: center;
            color: #666;
            padding: 20px;
        }
    </style>
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .material-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .material-item:hover {
            transform: translateY(-5px);
        }

        .grid-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .material-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            font-size: 14px;
        }

        .btn-expand {
            width: 100%;
            padding: 10px;
            border: none;
            background: transparent;
            color: #0b83ff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-expand:hover {
            color: #0969d7;
        }

        @media (max-width: 768px) {
            .image-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>

            /* Reset any conflicting styles */
        .tab-content {
            position: relative;
        }

        .tab-pane {
            display: none !important; /* Force hide all panes */
        }

        .tab-pane.active {
            display: block !important; /* Force show active pane */
        }

        /* Basic tab styling */
        .tab-menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            border-bottom: 1px solid #ddd;
        }

        .tab-item {
            padding: 10px 20px;
            cursor: pointer;
        }

        .tab-item.active {
            border-bottom: 2px solid #0b83ff;
        }
    </style>
    <style>
        .timetable-grid {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .timetable-header {
            display: grid;
            grid-template-columns: 100px repeat(6, 1fr);
            background: #f8f9fa;
            text-align: center;
            font-weight: bold;
        }

        .timetable-header > div {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        .time-slot {
            display: grid;
            grid-template-columns: 100px repeat(6, 1fr);
        }

        .time-col {
            padding: 10px;
            background: #f8f9fa;
            font-weight: bold;
            border-right: 1px solid #ddd;
        }

        .schedule-cell {
            padding: 10px;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            min-height: 100px;
        }

        .class-item {
            background: #e3f2fd;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 5px;
        }

        .class-name {
            display: block;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .class-info,
        .class-time,
        .class-room {
            display: block;
            font-size: 0.9em;
            color: #666;
        }

        .no-schedule {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
    <style>
        /* Tab content styling */
        .tab-pane {
            padding: 20px;
        }

        .content-section {
            width: 100%;
        }

        .column-a {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Profile section styling */
        .section-box .profile-details {
            display: flex;
            flex-direction: column;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        /* Button container */
        .profile-actions {
            /*display: flex;*/
            gap: 15px;
            margin-top: 20px;
        }

        /* Button styling */
        .profile-actions .btn {
            flex: 1; /* Make buttons equal width */
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-align: center;
            white-space: nowrap;
        }

        .profile-actions .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .profile-actions .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }

        .profile-actions .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
        }

        .modal.fade {
            transition: opacity 0.15s linear;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show {
            display: block;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            max-width: 500px;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 9px rgba(0,0,0,.5);
        }

        .modal-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-body {
            padding: 1rem;
        }

        .modal-footer {
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Form styling */
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            outline: 0;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .profile-actions {
                flex-direction: column;
            }

            .modal-dialog {
                margin: 0.5rem;
            }
        }
    </style>

    <style>
        /* Modal base styles */
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: none;
        }

        /* Modal header */
        .modal-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 1.25rem;
            color: #333;
            margin: 0;
        }

        /* Close button */
        .btn-close {
            width: 1.5em;
            height: 1.5em;
            padding: 0.25em;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            border-radius: 0.25rem;
            opacity: .5;
            cursor: pointer;
        }

        .btn-close:hover {
            opacity: .75;
        }

        /* Modal body */
        .modal-body {
            padding: 1rem;
            max-height: calc(100vh - 210px);
            overflow-y: auto;
        }

        /* Form controls */
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #212529;
        }

        .form-control {
            display: block;
            width: 100%;
            max-width: 100%; /* Ensure input stays within container */
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .form-control:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }

        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        /* Modal footer */
        .modal-footer {
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Footer buttons */
        .modal-footer .btn {
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .modal-footer .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border: 1px solid #6c757d;
        }

        .modal-footer .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
        }

        .modal-footer .btn:hover {
            opacity: 0.85;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }

            .modal-body {
                max-height: calc(100vh - 180px);
            }
        }

        /* Modal backdrop */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.fade .modal-dialog {
            transition: transform .3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }
    </style>

    <style>
        .video-library {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .image-grid, .hidden-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .material-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            aspect-ratio: 16/9;
        }

        .grid-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .material-name {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
        }

        .btn-expand {
            width: 100%;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-expand i {
            transition: transform 0.3s ease;
        }

        .btn-expand.expanded i {
            transform: rotate(180deg);
        }

        @media (max-width: 768px) {
            .image-grid, .hidden-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <style>
        /* Hobbies specific styles */
        .hobbies-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .hobbies-title {
            font-size: 1.25rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .visible-hobbies, .hidden-hobbies {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .hobby-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .hobby-item:hover {
            transform: translateY(-5px);
        }

        .hobby-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .hobby-item:hover .hobby-image {
            transform: scale(1.05);
        }

        .hobby-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 12px;
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
            font-weight: 500;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .hobby-item:hover .hobby-label {
            transform: translateY(0);
        }

        .hobbies-expand-btn {
            width: 100%;
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .hobbies-expand-btn:hover {
            background: #e9ecef;
        }

        .hobbies-expand-btn i {
            transition: transform 0.3s ease;
        }

        .hobbies-expand-btn.expanded i {
            transform: rotate(180deg);
        }

        @media (max-width: 768px) {
            .visible-hobbies, .hidden-hobbies {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        .profile-section {
            margin-bottom: 20px;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .profile-section:last-child {
            border-bottom: none;
        }

        .section-subtitle {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .profile-text {
            color: #666;
            line-height: 1.6;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: #0d6efd;
        }

        .social-link i {
            margin-right: 5px;
        }

        .interests-display {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        #profileContact p {
            margin-bottom: 8px;
        }

        #profileContact p:last-child {
            margin-bottom: 0;
        }
    </style>
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 15px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 16/9;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }

        .gallery-title {
            display: block;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .gallery-date {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .category-section {
            margin-bottom: 30px;
        }

        .category-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <style>
        .transactions-table {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .amount {
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        .payment-method, .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
        }

        /* Payment method styles */
        .tien-mat { background: #e3f2fd; color: #1976d2; }
        .chuyen-khoan { background: #e8f5e9; color: #388e3c; }
        .the-tin-dung { background: #fce4ec; color: #c2185b; }

        /* Status styles */
        .thanh-cong { background: #e8f5e9; color: #388e3c; }
        .cho-xu-ly { background: #fff3e0; color: #f57c00; }
        .that-bai { background: #ffebee; color: #d32f2f; }

        /* Responsive design */
        @media (max-width: 768px) {
            .transactions-table {
                font-size: 0.9em;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>

    <style>
        .modal-lg {
            max-width: 900px;
        }

        .payment-info {
            padding: 15px;
        }

        .payment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .payment-id {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
        }

        .payment-date {
            color: #666;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .total-amount {
            font-size: 1.1em;
            color: #2196F3;
        }

        .discount-badge {
            background: #e8f5e9;
            color: #388e3c;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.9em;
        }
    </style>

    <div class="main-wrapper">
        <!-- Banner Row -->
        <div class="banner-row">
            <div class="banner-div">
                <img src="{{ Vite::asset('resources/image/cuong/tcn/banner.jpg') }}" alt="Banner" class="banner-image">
                <div class="avatar-container">
                    <img src="{{ Vite::asset('resources/image/cuong/tcn/avata.jpg') }}" alt="Avatar"
                         class="avatar-image">
                    <button class="avatar-edit-button" onclick="document.getElementById('avatar-input').click();">
                        <i class="fas fa-camera"></i> Sửa ảnh
                    </button>
                    <input type="file"
                           id="avatar-input"
                           accept="image/*"
                           style="display: none;"
                           onchange="changeAvatar(this)">
                </div>
                <div class="profile-info">
                    <h1 class="profile-name" id="profileName">{{ $profileName }}</h1>
                    <p class="profile-subtitle" id="profileJob">{{ $profileJob }}</p>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="content-row">
            <div class="content-div">
                <!-- Tab Menu -->
                <ul class="tab-menu">
                    <li class="tab-item active">Thông tin chung</li>
                    <li class="tab-item">Hồ sơ cá nhân</li>
                    <li class="tab-item">Thư viện</li>
                    <li class="tab-item">Lịch sử giao dịch</li>
                </ul>

                <!-- Add these tab content sections after the tab menu -->
                <div class="tab-content">
                    <!-- Discussions Tab (Default) -->
                    <div class="tab-pane active" id="discussions">
                        <div class="content-section">
                            <!-- Column A -->
                            <div class="column-a">

                                <!-- Class Details (Similar to Profile Details) -->
                                <div class="section-box profile-details">
                                    <h2 class="section-title">
                                        @if($vaiTro == 3)
                                            Danh sách môn học
                                        @elseif($vaiTro == 4)
                                            Danh sách lớp học
                                        @endif
                                    </h2>

                                    @if($items->isEmpty())
                                        <p class="no-items">Không có dữ liệu</p>
                                    @else
                                        <div class="items-container">
                                            @foreach($items->take(3) as $item)
                                                @if($vaiTro == 3)
                                                    <button class="btn">
                                                        {{ $item->ten_monhoc }}
                                                        <span
                                                            class="subject-info">{{ $item->so_tin_chi }} tín chỉ</span>
                                                    </button>
                                                @elseif($vaiTro == 4)
                                                    <button class="btn">
                                                        {{ $item->ten_lop }}
                                                        <span class="class-info">{{ $item->so_luong_sv }} SV</span>
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>

                                        @if($items->count() > 3)
                                            <div class="items-container collapsed">
                                                @foreach($items->skip(3) as $item)
                                                    @if($vaiTro == 3)
                                                        <button class="btn">
                                                            {{ $item->ten_monhoc }}
                                                            <span
                                                                class="subject-info">{{ $item->so_tin_chi }} tín chỉ</span>
                                                        </button>
                                                    @elseif($vaiTro == 4)
                                                        <button class="btn">
                                                            {{ $item->ten_lop }}
                                                            <span class="class-info">{{ $item->so_luong_sv }} SV</span>
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <button class="expand-btn" onclick="toggleExpand(this)">
                                                Xem thêm <i class="fas fa-chevron-down"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>

                                <!-- Learning Materials (Similar to Video Library) -->
                                <div class="section-box video-library">
                                    <h2 class="section-title">Tài liệu học tập</h2>
                                    <div class="image-grid">
                                        <!-- Visible items (first 4) -->
                                        <div class="material-item visible">
                                            <img src="https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?auto=format&fit=crop&q=80&w=300"
                                                 alt="Slide" class="grid-image">
                                            <span class="material-name">Slide bài giảng</span>
                                        </div>
                                        <div class="material-item visible">
                                            <img src="https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&q=80&w=300"
                                                 alt="Notes" class="grid-image">
                                            <span class="material-name">Ghi chú</span>
                                        </div>
                                        <div class="material-item visible">
                                            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=300"
                                                 alt="Library" class="grid-image">
                                            <span class="material-name">Thư viện</span>
                                        </div>
                                        <div class="material-item visible">
                                            <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80&w=300"
                                                 alt="Outline" class="grid-image">
                                            <span class="material-name">Đề cương</span>
                                        </div>
                                    </div>

                                    <!-- Hidden grid for expandable items -->
                                    <div class="hidden-grid" style="display: none;">
                                        <div class="material-item">
                                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=300"
                                                 alt="Extra 1" class="grid-image">
                                            <span class="material-name">Bài tập về nhà</span>
                                        </div>
                                        <div class="material-item">
                                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=300"
                                                 alt="Extra 2" class="grid-image">
                                            <span class="material-name">Tài liệu tham khảo</span>
                                        </div>
                                        <div class="material-item">
                                            <img src="https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?auto=format&fit=crop&q=80&w=300"
                                                 alt="Extra 3" class="grid-image">
                                            <span class="material-name">Bài giảng video</span>
                                        </div>
                                        <div class="material-item">
                                            <img src="https://images.unsplash.com/photo-1532619187608-e5375cab36aa?auto=format&fit=crop&q=80&w=300"
                                                 alt="Extra 4" class="grid-image">
                                            <span class="material-name">Tài liệu thực hành</span>
                                        </div>
                                    </div>

                                    <div class="materials-footer">
                                        <button class="btn-expand" id="materialsExpandBtn">
                                            <span>Xem thêm</span> <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Column B -->

                            </div>
                            <div class="column-b">
                                <!-- Schedule/Timetable -->
                                <div class="section-box">
                                    <h2 class="section-title">Thời khóa biểu</h2>
                                    @if($schedule->isNotEmpty())
                                        <div class="timetable-grid">
                                            <div class="timetable-header">
                                                <div class="time-col">Buổi</div>
                                                @php
                                                    $startDate = \Carbon\Carbon::parse($currentWeek);
                                                @endphp
                                                @for($i = 0; $i < 6; $i++)
                                                    @php
                                                        $currentDate = $startDate->copy()->addDays($i);
                                                    @endphp
                                                    <div>
                                                        {{ $currentDate->locale('vi')->dayName }}<br>
                                                        {{ $currentDate->format('d/m/Y') }}
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="timetable-body">
                                                @foreach(['Sáng' => ['06:00:00', '11:30:00'],
                                                         'Chiều' => ['13:00:00', '17:30:00'],
                                                         'Tối' => ['18:00:00', '21:30:00']] as $session => $hours)
                                                    <div class="time-slot">
                                                        <div class="time-col">{{ $session }}</div>
                                                        @for($i = 0; $i < 6; $i++)
                                                            @php
                                                                $currentDate = $startDate->copy()->addDays($i);
                                                                $sessionSchedules = $schedule->filter(function($item) use ($currentDate, $hours) {
                                                                    return $item->ngay_hoc == $currentDate->format('Y-m-d')
                                                                        && $item->gio_bat_dau >= $hours[0]
                                                                        && $item->gio_bat_dau < $hours[1];
                                                                });
                                                            @endphp
                                                            <div class="schedule-cell">
                                                                @foreach($sessionSchedules as $item)
                                                                    <div class="class-item">
                                                                        <span class="class-name">{{ $item->ten_monhoc }}</span>
                                                                        @if($vaiTro == 4)
                                                                            <span class="class-info">{{ $item->ten_lop }}</span>
                                                                        @endif
                                                                        <span class="class-time">
                                            {{ \Carbon\Carbon::parse($item->gio_bat_dau)->format('H:i') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->gio_ket_thuc)->format('H:i') }}
                                        </span>
                                                                        <span class="class-room">
                                            {{ $item->ten_phonghoc }}
                                                                            @if($item->khu_vuc)
                                                                                ({{ $item->khu_vuc }})
                                                                            @endif
                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endfor
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="no-schedule">Không có lịch học trong tuần này</p>
                                    @endif
                                </div>

                                <!-- Events -->
                                <div class="section-box">
                                    <h2 class="section-title">Upcoming Events</h2>
                                    <div class="events-list">
                                        <div class="event-item">
                                            <div class="event-date">
                                                <span class="date">15</span>
                                                <span class="month">Mar</span>
                                            </div>
                                            <div class="event-details">
                                                <h3>Science Fair</h3>
                                                <p>Annual science project presentation</p>
                                                <span class="event-time">09:00 AM - 03:00 PM</span>
                                            </div>
                                        </div>
                                        <!-- Add more events -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bio Tab -->
                    <div class="tab-pane" id="bio">
                        <div class="content-section">
                            <!-- Column A - Same as discussions -->
                            <div class="column-a">
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

                                <!-- Make sure Bootstrap JS is included -->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

                                <!-- Profile Details -->
                                <div class="section-box profile-details">
                                    <div>
                                        <h2 class="section-title">Thông tin cá nhân</h2>
                                        <div class="profile-actions">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateInfoModal">
                                                <i class="fas fa-user-edit"></i> Cập nhật thông tin
                                            </button>
                                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#securityModal">
                                                <i class="fas fa-shield-alt"></i> Tài khoản và bảo mật
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <!-- Modal Cập nhật thông tin -->
                                <div class="modal fade" id="updateInfoModal" tabindex="-1" aria-labelledby="updateInfoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateInfoModalLabel">Cập nhật thông tin cá nhân</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="updateInfoForm" method="POST" action="{{ route('nguoidung.updateInfo') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="kinh_nghiem" class="form-label">Kinh nghiệm</label>
                                                        <textarea class="form-control" id="kinh_nghiem" name="kinh_nghiem" rows="3">{{ $user->kinh_nghiem }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ky_nang_noi_bat" class="form-label">Kỹ năng nổi bật</label>
                                                        <textarea class="form-control" id="ky_nang_noi_bat" name="ky_nang_noi_bat" rows="3">{{ $user->ky_nang_noi_bat }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="thanh_tich" class="form-label">Thành tích</label>
                                                        <textarea class="form-control" id="thanh_tich" name="thanh_tich" rows="3">{{ $user->thanh_tich }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phuong_cham_song" class="form-label">Phương châm sống</label>
                                                        <textarea class="form-control" id="phuong_cham_song" name="phuong_cham_song" rows="2">{{ $user->phuong_cham_song }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                                        <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="{{ $user->so_dien_thoai }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="so_thich" class="form-label">Sở thích</label>
                                                        <textarea class="form-control" id="so_thich" name="so_thich" rows="2">{{ $user->so_thich }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Tài khoản và bảo mật -->
                                <div class="modal fade" id="securityModal" tabindex="-1" aria-labelledby="securityModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="securityModalLabel">Tài khoản và bảo mật</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="securityForm" method="POST" action="{{ route('nguoidung.updateSecurity') }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="ten_dang_nhap" class="form-label">Tên đăng nhập</label>
                                                        <input type="text" class="form-control" id="ten_dang_nhap" name="ten_dang_nhap" value="{{ $user->ten_dang_nhap }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mat_khau_cu" class="form-label">Mật khẩu hiện tại</label>
                                                        <input type="password" class="form-control" id="mat_khau_cu" name="mat_khau_cu">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mat_khau_moi" class="form-label">Mật khẩu mới</label>
                                                        <input type="password" class="form-control" id="mat_khau_moi" name="mat_khau_moi">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mat_khau_xacnhan" class="form-label">Xác nhận mật khẩu mới</label>
                                                        <input type="password" class="form-control" id="mat_khau_xacnhan" name="mat_khau_xacnhan">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="section-box hobbies-section">
                                    <h2 class="hobbies-title">Sở thích</h2>
                                    <div class="visible-hobbies">
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 1" class="hobby-image">
                                            <span class="hobby-label">Đọc sách</span>
                                        </div>
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 2" class="hobby-image">
                                            <span class="hobby-label">Âm nhạc</span>
                                        </div>
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 3" class="hobby-image">
                                            <span class="hobby-label">Du lịch</span>
                                        </div>
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 4" class="hobby-image">
                                            <span class="hobby-label">Thể thao</span>
                                        </div>
                                    </div>

                                    <div class="hidden-hobbies" style="display: none;">
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 5" class="hobby-image">
                                            <span class="hobby-label">Nấu ăn</span>
                                        </div>
                                        <div class="hobby-item">
                                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=300"
                                                 alt="Hobby 6" class="hobby-image">
                                            <span class="hobby-label">Nhiếp ảnh</span>
                                        </div>
                                    </div>

                                    <div class="hobbies-footer">
                                        <button class="hobbies-expand-btn" id="hobbiesExpandBtn">
                                            <span>Xem thêm</span>
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Column B - Profile Edit Form -->
                            <div class="column-b">
                                <div class="section-box">
                                    <h2 class="section-title">Thông tin cá nhân</h2>
                                    <div class="profile-content">
                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Kinh nghiệm</h3>
                                            <p id="profileExperience" class="profile-text">
                                                {{ $user->kinh_nghiem ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>

                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Kỹ năng nổi bật</h3>
                                            <p id="profileSkills" class="profile-text">
                                                {{ $user->ky_nang_noi_bat ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>

                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Thành tích</h3>
                                            <p id="profileAchievements" class="profile-text">
                                                {{ $user->thanh_tich ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>

                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Phương châm sống</h3>
                                            <p id="profileMotto" class="profile-text">
                                                {{ $user->phuong_cham_song ?? 'Chưa cập nhật' }}
                                            </p>
                                        </div>

                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Thông tin liên hệ</h3>
                                            <div id="profileContact" class="profile-text">
                                                <p id="profileEmail">Email: {{ $user->email ?? 'Chưa cập nhật' }}</p>
                                                <p id="profilePhone">SĐT: {{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</p>
                                                <p id="profileSocial">
                                                    @if(isset($user->social_links))
                                                        @foreach(json_decode($user->social_links, true) ?? [] as $platform => $link)
                                                            <a href="{{ $link }}" target="_blank" class="social-link">
                                                                <i class="fab fa-{{ strtolower($platform) }}"></i> {{ ucfirst($platform) }}
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        Chưa cập nhật liên kết mạng xã hội
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="profile-section">
                                            <h3 class="section-subtitle">Sở thích</h3>
                                            <div id="profileInterests" class="profile-text interests-display">
                                                {{ $user->so_thich ?? 'Chưa cập nhật' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Tab -->
                    <div class="tab-pane" id="gallery">
                        <div class="gallery-categories">
                            <!-- Kỷ niệm cá nhân -->
                            <div class="category-section">
                                <h3 class="category-title">Kỷ niệm cá nhân</h3>
                                <div class="gallery-header">
                                    <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('personal')">
                                        <i class="fas fa-plus"></i> Thêm hình ảnh
                                    </button>
                                    <input type="file" id="personal-upload" accept="image/*" multiple style="display: none;"
                                           onchange="handleGalleryUpload(this, 'personal')">
                                </div>
                                <div class="gallery-grid" id="personal-memories">
                                    <!-- Sample personal memories -->
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500&q=80" alt="Friends">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Gặp mặt bạn bè</span>
                                            <span class="gallery-date">20/12/2023</span>
                                        </div>
                                    </div>
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=500&q=80" alt="Party">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Sinh nhật</span>
                                            <span class="gallery-date">15/12/2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thành tích học tập -->
                            <div class="category-section">
                                <h3 class="category-title">Thành tích học tập</h3>
                                <div class="gallery-header">
                                    <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('academic')">
                                        <i class="fas fa-plus"></i> Thêm hình ảnh
                                    </button>
                                    <input type="file" id="academic-upload" accept="image/*" multiple style="display: none;"
                                           onchange="handleGalleryUpload(this, 'academic')">
                                </div>
                                <div class="gallery-grid" id="academic-achievements">
                                    <!-- Sample academic achievements -->
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=80" alt="Certificate">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Chứng chỉ IELTS</span>
                                            <span class="gallery-date">10/11/2023</span>
                                        </div>
                                    </div>
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=500&q=80" alt="Award">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Giải thưởng cuộc thi</span>
                                            <span class="gallery-date">05/10/2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hoạt động ngoại khóa -->
                            <div class="category-section">
                                <h3 class="category-title">Hoạt động ngoại khóa</h3>
                                <div class="gallery-header">
                                    <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('extracurricular')">
                                        <i class="fas fa-plus"></i> Thêm hình ảnh
                                    </button>
                                    <input type="file" id="extracurricular-upload" accept="image/*" multiple style="display: none;"
                                           onchange="handleGalleryUpload(this, 'extracurricular')">
                                </div>
                                <div class="gallery-grid" id="extracurricular-activities">
                                    <!-- Sample extracurricular activities -->
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1526976668912-1a811878dd37?w=500&q=80" alt="Volunteer">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Hoạt động tình nguyện</span>
                                            <span class="gallery-date">25/09/2023</span>
                                        </div>
                                    </div>
                                    <div class="gallery-item">
                                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500&q=80" alt="Club">
                                        <div class="gallery-overlay">
                                            <span class="gallery-title">Câu lạc bộ tiếng Anh</span>
                                            <span class="gallery-date">15/09/2023</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Tab -->
                    <div class="tab-pane" id="transactions">
                        <div class="transactions-wrapper">
                            <div class="transactions-header">
                                <h3>Lịch sử giao dịch</h3>
                            </div>
                            <div class="transactions-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Mã giao dịch</th>
                                        <th>Ngày giờ</th>
                                        <th>Loại giao dịch</th>
                                        <th>Mô tả</th>
                                        <th>Số tiền</th>
                                        <th>Phương thức</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="transactionsBody">
                                    @php
                                        // Lấy ID người dùng đang đăng nhập
                                        $userId = Auth::id();

                                        // Query học phí của sinh viên
                                        $hocPhiList = DB::table('hocphi')
                                            ->where('id_sinhvien', $userId)
                                            ->get();

                                        // Lấy danh sách thanh toán
                                        $payments = [];
                                        foreach($hocPhiList as $hocPhi) {
                                            $thanhToanList = DB::table('thanhtoan')
                                                ->where('id_hocphi', $hocPhi->id_hocphi)
                                                ->orderBy('ngay_thanhtoan', 'desc')
                                                ->get();
                                            $payments = array_merge($payments, $thanhToanList->toArray());
                                        }
                                    @endphp

                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>TT{{ str_pad($payment->id_thanhtoan, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($payment->ngay_thanhtoan)->format('d/m/Y H:i') }}</td>
                                            <td>Học phí</td>
                                            <td>Thanh toán học phí kỳ {{ ceil($loop->iteration/2) }}</td>
                                            <td class="amount">{{ number_format($payment->so_tien_da_tra, 0, ',', '.') }} đ</td>
                                            <td>
                                <span class="payment-method {{ strtolower(str_replace(' ', '-', $payment->phuong_thuc)) }}">
                                    {{ $payment->phuong_thuc }}
                                </span>
                                            </td>
                                            <td>
                                <span class="status {{ strtolower(str_replace(' ', '-', $payment->trang_thai)) }}">
                                    {{ $payment->trang_thai }}
                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="viewTransaction({{ $payment->id_thanhtoan }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="transactionModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chi tiết học phí</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="payment-info">
                                        <div class="payment-header">
                                            <div class="payment-id"></div>
                                            <div class="payment-date"></div>
                                        </div>
                                        <div class="payment-details">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Tên khoản phí</th>
                                                    <th>Môn học</th>
                                                    <th>Số tiền</th>
                                                    <th>Miễn giảm</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody id="detailsTable">
                                                <!-- Data will be inserted here -->
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                                    <td class="total-amount fw-bold"></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        @endsection
        @section('scripts')

            <script>
                function toggleExpand(btn) {
                    const container = btn.previousElementSibling;
                    const isExpanded = container.style.maxHeight;

                    if (!isExpanded) {
                        container.style.maxHeight = container.scrollHeight + "px";
                        btn.classList.add('expanded');
                        btn.innerHTML = 'Thu gọn <i class="fas fa-chevron-up"></i>';
                    } else {
                        container.style.maxHeight = null;
                        btn.classList.remove('expanded');
                        btn.innerHTML = 'Xem thêm <i class="fas fa-chevron-down"></i>';
                    }
                }

                // Set initial max-height for collapsed containers


                document.addEventListener('DOMContentLoaded', function() {
                    const collapsedContainers = document.querySelectorAll('.items-container.collapsed');
                    collapsedContainers.forEach(container => {
                        container.style.maxHeight = '0';
                    });
                    const tabs = document.querySelectorAll('.tab-item');
                    const panes = document.querySelectorAll('.tab-pane');

                    function activateTab(tabText) {
                        // Remove active class from all tabs and panes
                        tabs.forEach(t => t.classList.remove('active'));
                        panes.forEach(p => {
                            p.classList.remove('active');
                            p.style.display = 'none'; // Force hide
                        });

                        // Find the clicked tab and activate it
                        const clickedTab = Array.from(tabs).find(t => t.textContent.trim() === tabText);
                        if (clickedTab) {
                            clickedTab.classList.add('active');
                        }

                        // Map tab text to pane ID
                        let paneId;
                        switch(tabText) {
                            case 'Hồ sơ cá nhân':
                                paneId = 'bio';
                                break;
                            case 'Thư viện':
                                paneId = 'gallery';
                                break;
                            case 'Lịch sử giao dịch':
                                paneId = 'transactions';
                                break;
                            default:
                                paneId = 'discussions';
                        }

                        // Find and activate the corresponding pane
                        const targetPane = document.getElementById(paneId);
                        if (targetPane) {
                            targetPane.classList.add('active');
                            targetPane.style.display = 'block'; // Force show
                            console.log('Activated pane:', paneId);
                        }
                    }

                    // Add click handlers to tabs
                    tabs.forEach(tab => {
                        tab.addEventListener('click', () => {
                            const tabText = tab.textContent.trim();
                            activateTab(tabText);
                        });
                    });

                    // Debug logging
                    console.log('Tabs found:', tabs.length);
                    console.log('Panes found:', panes.length);
                    panes.forEach(pane => {
                        console.log('Pane ID:', pane.id, 'Display:', getComputedStyle(pane).display);
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle Info Form Submit
                    const updateInfoForm = document.getElementById('updateInfoForm');
                    updateInfoForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // Create FormData object
                        const formData = new FormData(this);
                        // Convert FormData to JSON
                        const jsonData = Object.fromEntries(formData.entries());

                        fetch('{{ route("nguoidung.updateInfo") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(jsonData)
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Success case
                                    alert(data.message);
                                    // Close modal without jQuery
                                    const modal = document.getElementById('updateInfoModal');
                                    const modalInstance = bootstrap.Modal.getInstance(modal);
                                    modalInstance.hide();
                                    // Reload page
                                    window.location.reload();
                                } else {
                                    // Error case from server
                                    alert(data.message || 'Có lỗi xảy ra khi cập nhật thông tin!');
                                }
                            })
                            .catch(error => {
                                // Network or other errors
                                console.error('Error:', error);
                                alert('Có lỗi xảy ra khi cập nhật thông tin!');
                            });
                    });

                    // Handle Security Form Submit
                    const securityForm = document.getElementById('securityForm');
                    securityForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // Password validation
                        const newPass = document.getElementById('mat_khau_moi').value;
                        const confirmPass = document.getElementById('mat_khau_xacnhan').value;

                        if (newPass !== confirmPass) {
                            alert('Mật khẩu xác nhận không khớp!');
                            return;
                        }

                        // Create FormData object
                        const formData = new FormData(this);
                        // Convert FormData to JSON
                        const jsonData = Object.fromEntries(formData.entries());

                        fetch('{{ route("nguoidung.updateSecurity") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(jsonData)
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Success case
                                    alert(data.message);
                                    // Close modal without jQuery
                                    const modal = document.getElementById('securityModal');
                                    const modalInstance = bootstrap.Modal.getInstance(modal);
                                    modalInstance.hide();
                                    // Reload page
                                    window.location.reload();
                                } else {
                                    // Error case from server
                                    alert(data.message || 'Có lỗi xảy ra khi cập nhật thông tin bảo mật!');
                                }
                            })
                            .catch(error => {
                                // Network or other errors
                                console.error('Error:', error);
                                alert('Có lỗi xảy ra khi cập nhật thông tin bảo mật!');
                            });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const expandBtn = document.getElementById('expandMaterialsBtn');
                    const hiddenItems = document.querySelectorAll('.material-item.material-hidden');
                    let isExpanded = false;

                    // Only show expand button if there are hidden items
                    if (hiddenItems.length === 0) {
                        expandBtn.style.display = 'none';
                    }

                    expandBtn.addEventListener('click', function() {
                        isExpanded = !isExpanded;

                        hiddenItems.forEach(item => {
                            item.style.display = isExpanded ? 'block' : 'none';
                        });

                        // Update button text and icon
                        this.innerHTML = isExpanded ?
                            'Thu gọn <i class="fas fa-chevron-up"></i>' :
                            'Xem thêm <i class="fas fa-chevron-down"></i>';

                        this.classList.toggle('expanded');
                    });

                    // Handle add new material
                    document.getElementById('addMaterialBtn').addEventListener('click', function() {
                        alert('Tính năng đang được phát triển!');
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const expandBtn = document.getElementById('materialsExpandBtn');
                    const hiddenGrid = document.querySelector('.hidden-grid');
                    let isExpanded = false;

                    expandBtn.addEventListener('click', function() {
                        isExpanded = !isExpanded;

                        // Toggle hidden grid
                        hiddenGrid.style.display = isExpanded ? 'grid' : 'none';

                        // Update button text and icon
                        const buttonSpan = this.querySelector('span');
                        const buttonIcon = this.querySelector('i');

                        buttonSpan.textContent = isExpanded ? 'Thu gọn' : 'Xem thêm';
                        buttonIcon.style.transform = isExpanded ? 'rotate(180deg)' : 'rotate(0)';

                        // Smooth scroll to hidden content when expanding
                        if (isExpanded) {
                            hiddenGrid.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    });
                });
            </script>
            <script>
                // Separate script for hobbies section
                document.addEventListener('DOMContentLoaded', function() {
                    const hobbiesExpandBtn = document.getElementById('hobbiesExpandBtn');
                    const hiddenHobbies = document.querySelector('.hidden-hobbies');
                    let isHobbiesExpanded = false;

                    if (hobbiesExpandBtn && hiddenHobbies) {
                        hobbiesExpandBtn.addEventListener('click', function() {
                            isHobbiesExpanded = !isHobbiesExpanded;

                            // Toggle hidden hobbies
                            hiddenHobbies.style.display = isHobbiesExpanded ? 'grid' : 'none';

                            // Update button text and icon
                            const buttonSpan = this.querySelector('span');
                            const buttonIcon = this.querySelector('i');

                            buttonSpan.textContent = isHobbiesExpanded ? 'Thu gọn' : 'Xem thêm';
                            buttonIcon.style.transform = isHobbiesExpanded ? 'rotate(180deg)' : 'rotate(0)';

                            // Smooth scroll to hidden content when expanding
                            if (isHobbiesExpanded) {
                                hiddenHobbies.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        });
                    }
                });
            </script>

            <script>
                function viewTransaction(id) {
                    // Hiển thị chi tiết giao dịch
                    alert('Xem chi tiết giao dịch: ' + id);
                }

                function showTransactionForm() {
                    // Hiển thị form thêm giao dịch mới
                    alert('Hiển thị form thêm giao dịch mới');
                }
            </script>

            <script>
                async function viewTransaction(paymentId) {
                    try {
                        // Fetch payment details
                        const response = await fetch(`{{ route('cuong.getPaymentDetails', '') }}/${paymentId}`);
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();

                        // Update modal content
                        document.querySelector('.payment-id').textContent = `Mã giao dịch: TT${String(paymentId).padStart(6, '0')}`;
                        document.querySelector('.payment-date').textContent = `Ngày: ${new Date(data.payment.ngay_thanhtoan).toLocaleDateString('vi-VN')}`;

                        // Clear existing table content
                        const detailsTable = document.getElementById('detailsTable');
                        detailsTable.innerHTML = '';

                        // Add details rows
                        let totalAmount = 0;
                        data.details.forEach(detail => {
                            const row = document.createElement('tr');
                            const discountAmount = detail.id_mien_giam ? (detail.so_tien * detail.ty_le_mien_giam / 100) : 0;
                            const finalAmount = detail.so_tien - discountAmount;
                            totalAmount += finalAmount;

                            row.innerHTML = `
                <td>${detail.ten_khoan_phi}</td>
                <td>${detail.ten_monhoc || 'N/A'}</td>
                <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(detail.so_tien)}</td>
                <td>${detail.id_mien_giam ?
                                `<span class="discount-badge">${detail.ty_le_mien_giam}%</span>` :
                                'Không'}</td>
                <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(finalAmount)}</td>
            `;
                            detailsTable.appendChild(row);
                        });

                        // Update total amount
                        document.querySelector('.total-amount').textContent =
                            new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalAmount);

                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById('transactionModal'));
                        modal.show();

                    } catch (error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi tải thông tin chi tiết');
                    }
                }
            </script>
@endsection
