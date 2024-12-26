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
    margin-left:20px;
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

.profile-actions {
    position: absolute;
    bottom: -50px;
    right: 50px;
    z-index: 3;
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

/* Tab Menu */
.tab-menu {
    display: flex;
    border-bottom: 1px solid #ddd;
    margin: 30px 0;
    padding: 0;
    list-style: none;
}

.tab-item {
    padding: 10px 20px;
    cursor: pointer;
    color: #666;
}

.tab-item.active {
    color: #0b83ff;
    border-bottom: 2px solid #0b83ff;
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
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

/* Update profile details button styles */
.profile-details .btn {
    display: block;
    width: calc(100% - 40px);
    margin: 0 0 15px 0;
    padding: 12px 20px;
    text-align: left;
    background-color: #0b83ff;
    color: #fff;
    transition: all 0.3s;
    border-radius: 8px;
}

.profile-details .btn:last-child {
    margin-bottom: 0;
}

.profile-details .btn:hover {
    background-color: #0969d7;
}

/* Update section-box padding for profile details */
.profile-details.section-box {
    padding: 25px;
}

/* Update section title margin for profile details */
.profile-details .section-title {
    margin-bottom: 25px;
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

/* Tab Content Styles */
.tab-content {
    width: 100%;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
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
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.material-name {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 8px;
    background: rgba(0,0,0,0.7);
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
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    background: rgba(0,0,0,0.7);
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

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    overflow-y: auto;
    padding: 20px 0;
}

.modal-content {
    background-color: #fff;
    margin: 30px auto;
    padding: 20px;
    border-radius: 8px;
    width: 800px;
    max-width: 90%;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.close {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 24px;
    color: #666;
    transition: color 0.3s;
}

.close:hover {
    color: #0b83ff;
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
.modal h2 {
    padding: 0 10px 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    font-size: 20px;
    color: #333;
}

/* Cải thiện nút đóng */
.close {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 24px;
    color: #666;
    transition: color 0.3s;
}

.close:hover {
    color: #0b83ff;
}

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
@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        margin: 10px auto;
    }
    
    .details-form .contact-inputs {
        grid-template-columns: 1fr;
    }
}

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

.interests-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 20px;
    max-height: none;
    overflow: visible;
}

.interest-item {
    position: relative;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    transition: all 0.3s;
}

.interest-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}

.interest-item i {
    font-size: 24px;
    color: #0b83ff;
    margin-bottom: 8px;
}

.interest-item .interest-label {
    font-size: 14px;
    color: #333;
    margin-top: 5px;
}

.predefined-interests {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.predefined-interests .interest-item {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
}

.predefined-interests .interest-item:hover {
    background: #e9ecef;
}

.predefined-interests input[type="checkbox"] {
    margin-right: 10px;
}

.custom-interest-input {
    display: flex;
    gap: 10px;
}

.custom-interest-input .form-input {
    flex: 1;
}

.interests-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
}

.interest-image-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    width: 100%;
    height: 250px;
}

.interest-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.interest-image-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 5px;
    opacity: 0;
    transition: opacity 0.3s;
}

.interest-image-container:hover .interest-image-actions {
    opacity: 1;
}

.interest-image-actions button {
    padding: 5px 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.interest-image-actions button:hover {
    background: rgba(0, 0, 0, 0.9);
}

.hidden-interests {
    display: none;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 15px;
}

.hidden-interests .interest-image-container {
    height: 250px;
}

.interests-input {
    margin-top: 10px;
}

.interests-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.interest-tag {
    background: #e9ecef;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 14px;
    color: #333;
    display: flex;
    align-items: center;
    gap: 5px;
}

.interest-tag button {
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 0 2px;
}

.interest-tag button:hover {
    color: #dc3545;
}

.interests-display {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.interests-display span {
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 14px;
    color: #333;
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

.video-categories {
    padding: 20px;
}

.video-header {
    padding: 10px 0;
    display: flex;
    justify-content: flex-end;
}

.video-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 15px;
}

.video-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
}

.video-item video {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
}

.video-caption {
    padding: 10px;
    font-size: 14px;
    color: #333;
}

.video-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 5px;
    opacity: 0;
    transition: opacity 0.3s;
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

.edit-profile-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.edit-profile-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    position: relative;
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

<div class="main-wrapper">
    <!-- Banner Row -->
    <div class="banner-row">
        <div class="banner-div">
            <img src="{{ Vite::asset('resources/image/cuong/tcn/banner.jpg') }}" alt="Banner" class="banner-image">
            <div class="avatar-container">
                <img src="{{ Vite::asset('resources/image/cuong/tcn/avata.jpg') }}" alt="Avatar" class="avatar-image">
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
                <h1 class="profile-name" id="profileName">John Doe</h1>
                <p class="profile-subtitle" id="profileJob">Science Educator</p>
            </div>
            <div class="profile-actions">
                <button class="btn btn-primary" onclick="editProfileInfo()">
                    <i class="fas fa-edit"></i> Sửa thông tin
                </button>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="content-row">
        <div class="content-div">
            <!-- Tab Menu -->
            <ul class="tab-menu">
                <li class="tab-item active">Discussions</li>
                <li class="tab-item">Bio</li>
                <li class="tab-item">Gallery</li>
                <li class="tab-item">Transactions</li>
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
                                <h2 class="section-title">Class Details</h2>
                                <button class="btn">Science Class</button>
                                <button class="btn">Math Class</button>
                                <button class="btn">History Class</button>
                            </div>

                            <!-- Learning Materials (Similar to Video Library) -->
                            <div class="section-box video-library">
                                <h2 class="section-title">Learning Materials</h2>
                                <div class="image-grid">
                                    <div class="material-item">
                                        <img src="{{ Vite::asset('resources/image/cuong/tcn/physic.jpg') }}" alt="Material 1" class="grid-image">
                                        <span class="material-name">Physics Notes</span>
                                    </div>
                                    <div class="material-item">
                                        <img src="{{ Vite::asset('resources/image/cuong/tcn/chemistry.jpg') }}" alt="Material 2" class="grid-image">
                                        <span class="material-name">Chemistry Lab</span>
                                    </div>
                                    <div class="material-item">
                                        <img src="{{ Vite::asset('resources/image/cuong/tcn/biology.jpg') }}" alt="Material 3" class="grid-image">
                                        <span class="material-name">Biology Slides</span>
                                    </div>
                                    <div class="material-item">
                                        <img src="{{ Vite::asset('resources/image/cuong/tcn/math.jpg') }}" alt="Material 4" class="grid-image">
                                        <span class="material-name">Math Problems</span>
                                    </div>
                                </div>
                                <div class="materials-footer">
                                    <div class="hidden-materials" style="display: none;">
                                        <div class="material-item">
                                            <img src="{{ Vite::asset('resources/image/cuong/tcn/physic.jpg') }}" alt="Material 5" class="grid-image">
                                            <span class="material-name">Advanced Physics</span>
                                        </div>
                                        <div class="material-item">
                                            <img src="{{ Vite::asset('resources/image/cuong/tcn/chemistry.jpg') }}" alt="Material 6" class="grid-image">
                                            <span class="material-name">Advanced Chemistry</span>
                                        </div>
                                    </div>
                                    <button class="btn-expand" style="margin-top: 20px;">
                                        <span>See more</span> <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Column B -->
                        <div class="column-b">
                            <!-- Schedule/Timetable -->
                            <div class="section-box">
                                <h2 class="section-title">Class Schedule</h2>
                                <div class="timetable-grid">
                                    <div class="timetable-header">
                                        <div class="time-col">Time</div>
                                        <div>Monday</div>
                                        <div>Tuesday</div>
                                        <div>Wednesday</div>
                                        <div>Thursday</div>
                                        <div>Friday</div>
                                    </div>
                                    <div class="timetable-body">
                                        <div class="time-slot">
                                            <div class="time-col">08:00</div>
                                            <div class="class-item">
                                                <span class="class-name">Physics</span>
                                                <span class="class-room">Room 301</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Chemistry</span>
                                                <span class="class-room">Lab 201</span>
                                            </div>
                                            <div class="empty-slot"></div>
                                            <div class="class-item">
                                                <span class="class-name">Biology</span>
                                                <span class="class-room">Room 401</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Math</span>
                                                <span class="class-room">Room 202</span>
                                            </div>
                                        </div>
                                        <div class="time-slot">
                                            <div class="time-col">10:00</div>
                                            <div class="class-item">
                                                <span class="class-name">Math</span>
                                                <span class="class-room">Room 202</span>
                                            </div>
                                            <div class="empty-slot"></div>
                                            <div class="class-item">
                                                <span class="class-name">Physics</span>
                                                <span class="class-room">Lab 301</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Chemistry</span>
                                                <span class="class-room">Lab 201</span>
                                            </div>
                                            <div class="empty-slot"></div>
                                        </div>
                                        <div class="time-slot">
                                            <div class="time-col">13:00</div>
                                            <div class="empty-slot"></div>
                                            <div class="class-item">
                                                <span class="class-name">Biology</span>
                                                <span class="class-room">Room 401</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Math</span>
                                                <span class="class-room">Room 202</span>
                                            </div>
                                            <div class="empty-slot"></div>
                                            <div class="class-item">
                                                <span class="class-name">Physics</span>
                                                <span class="class-room">Lab 301</span>
                                            </div>
                                        </div>
                                        <div class="time-slot">
                                            <div class="time-col">15:00</div>
                                            <div class="class-item">
                                                <span class="class-name">Chemistry</span>
                                                <span class="class-room">Lab 201</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Physics</span>
                                                <span class="class-room">Room 301</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Biology</span>
                                                <span class="class-room">Room 401</span>
                                            </div>
                                            <div class="class-item">
                                                <span class="class-name">Math</span>
                                                <span class="class-room">Room 202</span>
                                            </div>
                                            <div class="empty-slot"></div>
                                        </div>
                                    </div>
                                </div>
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
                            <!-- Profile Details -->
                            <div class="section-box profile-details">
                                <h2 class="section-title">Profile Details</h2>
                                <div class="bio-preview" style="margin-bottom: 15px; display: none;">
                                    <p id="bioText" style="color: #666; font-size: 14px; line-height: 1.5; margin-bottom: 10px;"></p>
                                </div>
                                <div class="details-preview" style="margin-bottom: 15px; display: none;">
                                    <div class="detail-item">
                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 5px;">Kinh nghiệm</h3>
                                        <p id="experienceText" style="color: #666; font-size: 14px; margin-bottom: 10px;"></p>
                                    </div>
                                    <div class="detail-item">
                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 5px;">Kỹ năng nổi bật</h3>
                                        <p id="skillsText" style="color: #666; font-size: 14px; margin-bottom: 10px;"></p>
                                    </div>
                                    <div class="detail-item">
                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 5px;">Thành tích</h3>
                                        <p id="achievementsText" style="color: #666; font-size: 14px; margin-bottom: 10px;"></p>
                                    </div>
                                    <div class="detail-item">
                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 5px;">Phương châm sống</h3>
                                        <p id="mottoText" style="color: #666; font-size: 14px; margin-bottom: 10px;"></p>
                                    </div>
                                    <div class="detail-item">
                                        <h3 style="font-size: 15px; color: #333; margin-bottom: 5px;">Thông tin liên hệ</h3>
                                        <p id="contactText" style="color: #666; font-size: 14px;"></p>
                                    </div>
                                </div>
                                <button class="btn" id="updateBioBtn">Update bio</button>
                                <button class="btn" id="modifyDetailsBtn">Modify details</button>
                            </div>

                            <!-- Video Library -->
                            <div class="section-box interests-section">
                                <h2 class="section-title">Sở thích</h2>
                                <div class="interests-header">
                                    <button class="btn btn-primary" id="addInterestImageBtn">
                                        <i class="fas fa-plus"></i> Thêm hình ảnh
                                    </button>
                                </div>
                                <div class="interests-grid">
                                </div>
                                <div class="hidden-interests">
                                </div>
                                <button class="btn btn-expand">
                                    See more <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Column B - Profile Edit Form -->
                        <div class="column-b">
                            <div class="section-box">
                                <h2 class="section-title">Profile</h2>
                                <div class="profile-content">
                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Kinh nghiệm</h3>
                                        <p id="profileExperience" class="profile-text"></p>
                                    </div>

                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Kỹ năng nổi bật</h3>
                                        <p id="profileSkills" class="profile-text"></p>
                                    </div>

                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Thành tích</h3>
                                        <p id="profileAchievements" class="profile-text"></p>
                                    </div>

                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Phương châm sống</h3>
                                        <p id="profileMotto" class="profile-text"></p>
                                    </div>

                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Thông tin liên hệ</h3>
                                        <div id="profileContact" class="profile-text">
                                            <p id="profileEmail"></p>
                                            <p id="profilePhone"></p>
                                            <p id="profileSocial"></p>
                                        </div>
                                    </div>

                                    <div class="profile-section">
                                        <h3 class="section-subtitle">Sở thích</h3>
                                        <div id="profileInterests" class="profile-text interests-display"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Tab -->
                <div class="tab-pane" id="gallery">
                    <div class="gallery-categories">
                        <div class="category-section">
                            <h3 class="category-title">Kỷ niệm cá nhân</h3>
                            <div class="gallery-header">
                                <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('personal')">
                                    <i class="fas fa-plus"></i> Thêm hình ảnh
                                </button>
                                <input type="file" 
                                       id="personal-upload" 
                                       accept="image/*" 
                                       multiple 
                                       style="display: none;" 
                                       onchange="handleGalleryUpload(this, 'personal')">
                            </div>
                            <div class="gallery-grid" id="personal-memories"></div>
                        </div>

                        <div class="category-section">
                            <h3 class="category-title">Thành tích học tập</h3>
                            <div class="gallery-header">
                                <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('academic')">
                                    <i class="fas fa-plus"></i> Thêm hình ảnh
                                </button>
                                <input type="file" 
                                       id="academic-upload" 
                                       accept="image/*" 
                                       multiple 
                                       style="display: none;" 
                                       onchange="handleGalleryUpload(this, 'academic')">
                            </div>
                            <div class="gallery-grid" id="academic-achievements"></div>
                        </div>

                        <div class="category-section">
                            <h3 class="category-title">Hoạt động ngoại khóa</h3>
                            <div class="gallery-header">
                                <button class="btn btn-primary gallery-add-btn" onclick="openGalleryUpload('extracurricular')">
                                    <i class="fas fa-plus"></i> Thêm hình ảnh
                                </button>
                                <input type="file" 
                                       id="extracurricular-upload" 
                                       accept="image/*" 
                                       multiple 
                                       style="display: none;" 
                                       onchange="handleGalleryUpload(this, 'extracurricular')">
                            </div>
                            <div class="gallery-grid" id="extracurricular-activities"></div>
                        </div>
                    </div>
                </div>

                <!-- Transactions Tab -->
                <div class="tab-pane" id="transactions">
                    <div class="transactions-wrapper">
                        <div class="transactions-header">
                            <h3>Lịch sử giao dịch</h3>
                            <button class="btn btn-primary" onclick="showTransactionForm()">
                                <i class="fas fa-plus"></i> Thêm giao dịch mới
                            </button>
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
                                    <!-- Dữ liệu giao dịch sẽ được thêm vào đây -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this JavaScript at the bottom of the file -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const expandButtons = document.querySelectorAll('.btn-expand');
    
    expandButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const parentSection = this.closest('.video-library');
            const hiddenMaterials = parentSection.querySelector('.hidden-materials');
            
            if (hiddenMaterials.style.display === 'none') {
                // Show hidden materials
                hiddenMaterials.style.display = 'grid';
                this.innerHTML = 'See less <i class="fas fa-chevron-up"></i>';
                this.classList.add('expanded');
            } else {
                // Hide materials
                hiddenMaterials.style.display = 'none';
                this.innerHTML = 'See more <i class="fas fa-chevron-down"></i>';
                this.classList.remove('expanded');
            }
        });
    });

    // Tab switching functionality
    const tabItems = document.querySelectorAll('.tab-item');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabItems.forEach(tab => {
        tab.addEventListener('click', function() {
            tabItems.forEach(item => item.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.textContent.toLowerCase().trim();
            document.getElementById(tabId).classList.add('active');
        });
    });

    const modal = document.getElementById('bioModal');
    const btn = document.getElementById('updateBioBtn');
    const span = document.getElementsByClassName('close')[0];
    const bioPreview = document.querySelector('.bio-preview');
    const bioText = document.getElementById('bioText');
    const bioForm = document.querySelector('.bio-form');
    const bioTextarea = bioForm.querySelector('textarea');

    // Mở modal khi click nút Update bio
    btn.onclick = function() {
        modal.style.display = "block";
        if (bioText.textContent) {
            bioTextarea.value = bioText.textContent;
        }
    }

    // Đóng modal khi click nút X
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Xử lý submit form bio
    bioForm.onsubmit = function(e) {
        e.preventDefault();
        const bioContent = bioTextarea.value.trim();
        
        if (bioContent) {
            bioText.textContent = bioContent;
            bioPreview.style.display = "block";
            modal.style.display = "none";
        } else {
            bioPreview.style.display = "none";
        }
    }

    // Xử lý đóng modal khi click bên ngoài
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    const detailsModal = document.getElementById('detailsModal');
    const modifyDetailsBtn = document.getElementById('modifyDetailsBtn');
    const detailsForm = document.querySelector('.details-form');

    // Mở modal Modify Details
    modifyDetailsBtn.onclick = function() {
        detailsModal.style.display = "block";
        
        // Điền lại các thông tin khác
        document.getElementById('experience').value = document.getElementById('experienceText').textContent || '';
        document.getElementById('skills').value = document.getElementById('skillsText').textContent || '';
        document.getElementById('achievements').value = document.getElementById('achievementsText').textContent || '';
        document.getElementById('motto').value = document.getElementById('mottoText').textContent || '';

        // Lấy lại các sở thích đã có
        const profileInterests = document.getElementById('profileInterests');
        if (profileInterests) {
            const existingInterests = Array.from(profileInterests.children).map(span => span.textContent);
            if (existingInterests.length > 0) {
                interests = existingInterests;
                updateInterestsTags();
            }
        }
    }

    // Đóng modal khi click nút X
    detailsModal.querySelector('.close').onclick = function() {
        detailsModal.style.display = "none";
    }

    // Đóng modal khi click bên ngoài
    window.onclick = function(event) {
        if (event.target == detailsModal) {
            detailsModal.style.display = "none";
        }
    }

    // Xử lý submit form details
    detailsForm.onsubmit = function(e) {
        e.preventDefault();
        
        // Lấy các giá trị khác
        const experience = document.getElementById('experience').value.trim();
        const skills = document.getElementById('skills').value.trim();
        const achievements = document.getElementById('achievements').value.trim();
        const motto = document.getElementById('motto').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const social = document.getElementById('social').value.trim();

        // Cập nhật các thông tin khác vào profile
        document.getElementById('profileExperience').textContent = experience;
        document.getElementById('profileSkills').textContent = skills;
        document.getElementById('profileAchievements').textContent = achievements;
        document.getElementById('profileMotto').textContent = motto;
        document.getElementById('profileEmail').textContent = `Email: ${email}`;
        document.getElementById('profilePhone').textContent = `Điện thoại: ${phone}`;
        document.getElementById('profileSocial').textContent = `Mạng xã hội: ${social}`;

        // Cập nhật s��� thích vào profile
        const profileInterests = document.getElementById('profileInterests');
        if (profileInterests && interests.length > 0) {
            profileInterests.innerHTML = interests.map(interest => 
                `<span>${interest}</span>`
            ).join('');
        }

        detailsModal.style.display = "none";
    }

    // Cập nhật xử lý đóng modal khi click bên ngoài
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        if (event.target == detailsModal) {
            detailsModal.style.display = "none";
        }
    }

    const addInterestImageBtn = document.getElementById('addInterestImageBtn');
    const interestsGrid = document.querySelector('.interests-grid');
    const hiddenInterests = document.querySelector('.hidden-interests');
    const expandBtn = document.querySelector('.btn-expand');
    let imageCount = 0;

    // Xử lý thêm hình ảnh mới
    addInterestImageBtn.onclick = function() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.multiple = true;
        
        input.onchange = function(e) {
            const files = e.target.files;
            
            for(let file of files) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.className = 'interest-image-container';
                    
                    imageContainer.innerHTML = `
                        <img src="${e.target.result}" alt="Interest Image">
                        <div class="interest-image-actions">
                            <button onclick="changeImage(this)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteImage(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    
                    // Phân chia ảnh vào grid chính hoặc phần ẩn
                    imageCount++;
                    if (imageCount <= 6) {
                        interestsGrid.appendChild(imageContainer);
                    } else {
                        hiddenInterests.appendChild(imageContainer);
                        expandBtn.style.display = 'block';
                    }
                }
                
                reader.readAsDataURL(file);
            }
        }
        
        input.click();
    }

    // Xử lý nút See more/See less
    expandBtn.onclick = function() {
        if (hiddenInterests.style.display === 'none') {
            hiddenInterests.style.display = 'grid';
            this.innerHTML = 'See less <i class="fas fa-chevron-up"></i>';
        } else {
            hiddenInterests.style.display = 'none';
            this.innerHTML = 'See more <i class="fas fa-chevron-down"></i>';
        }
    }

    // Ẩn nút expand nếu không có ảnh ẩn
    if (hiddenInterests.children.length === 0) {
        expandBtn.style.display = 'none';
    }

    // Hàm thay đổi hình ảnh
    function changeImage(button) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = button.closest('.interest-image-container');
                    container.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
        
        input.click();
    }

    // Hàm xóa hình ảnh
    function deleteImage(button) {
        if(confirm('Bạn có chắc muốn xóa hình ảnh này?')) {
            const container = button.closest('.interest-image-container');
            container.remove();
        }
    }

    // Khai báo biến interests ở phạm vi cao hơn để có thể truy cập từ nhiều hàm
    let interests = [];
    const interestInput = document.getElementById('newInterestInput');
    const interestsList = document.getElementById('interestsList');

    // Xử lý thêm sở thích mới
    interestInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const interest = this.value.trim();
            if (interest && !interests.includes(interest)) {
                interests.push(interest);
                updateInterestsTags();
                this.value = '';
            }
        }
    });

    // Cập nhật hiển thị các tag sở thích
    function updateInterestsTags() {
        interestsList.innerHTML = interests.map(interest => `
            <div class="interest-tag">
                ${interest}
                <button onclick="removeInterest('${interest}')">×</button>
            </div>
        `).join('');
    }

    // Xóa sở thích
    window.removeInterest = function(interest) {
        interests = interests.filter(i => i !== interest);
        updateInterestsTags();
    }

    // Xử lý Gallery
    document.querySelectorAll('.gallery-add-btn').forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.multiple = true;
            
            input.onchange = function(e) {
                const files = e.target.files;
                const galleryGrid = document.getElementById(`${category}-${category === 'personal' ? 'memories' : category === 'academic' ? 'achievements' : 'activities'}`);
                
                if (galleryGrid) {
                    for(let file of files) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const caption = prompt('Nhập chú thích cho ảnh:', '');
                            
                            const galleryItem = document.createElement('div');
                            galleryItem.className = 'gallery-item';
                            
                            galleryItem.innerHTML = `
                                <img src="${e.target.result}" alt="Gallery Image">
                                <div class="image-caption">${caption || ''}</div>
                                <div class="image-actions">
                                    <button onclick="changeGalleryImage(this)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteGalleryImage(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button onclick="editCaption(this)">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </div>
                            `;
                            
                            galleryGrid.appendChild(galleryItem);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                } else {
                    console.error('Không tìm thấy grid cho danh mục:', category);
                }
            }
            
            input.click();
        });
    });

    // Thêm console.log để debug
    document.querySelectorAll('.gallery-header button').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Button clicked:', this.getAttribute('onclick'));
        });
    });

    // Xử lý thêm video
    document.querySelectorAll('.video-add-btn').forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'video/*';
            
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (file) {
                    const videoGrid = document.getElementById(`${category}-videos`);
                    const caption = prompt('Nhập mô tả cho video:', '');
                    
                    const videoItem = document.createElement('div');
                    videoItem.className = 'video-item';
                    
                    videoItem.innerHTML = `
                        <video controls>
                            <source src="${URL.createObjectURL(file)}" type="${file.type}">
                        </video>
                        <div class="video-caption">${caption || ''}</div>
                        <div class="video-actions">
                            <button onclick="changeVideo(this)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteVideo(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onclick="editVideoCaption(this)">
                                <i class="fas fa-pen"></i>
                            </button>
                        </div>
                    `;
                    
                    videoGrid.appendChild(videoItem);
                }
            }
            
            input.click();
        });
    });

    // Hàm thay đổi video
    window.changeVideo = function(button) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'video/*';
        
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                const container = button.closest('.video-item');
                const video = container.querySelector('video');
                const source = video.querySelector('source');
                source.src = URL.createObjectURL(file);
                source.type = file.type;
                video.load();
            }
        }
        
        input.click();
    }

    // Hàm xóa video
    window.deleteVideo = function(button) {
        if(confirm('Bạn có chắc muốn xóa video này?')) {
            const container = button.closest('.video-item');
            container.remove();
        }
    }

    // Hàm chỉnh sửa caption video
    window.editVideoCaption = function(button) {
        const container = button.closest('.video-item');
        const captionDiv = container.querySelector('.video-caption');
        const newCaption = prompt('Chỉnh sửa mô tả:', captionDiv.textContent);
        if (newCaption !== null) {
            captionDiv.textContent = newCaption;
        }
    }

    window.addVideo = function(category) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'video/*';
        
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                const videoGrid = document.getElementById(`${category}-videos`);
                const caption = prompt('Nhập mô tả cho video:', '');
                
                const videoItem = document.createElement('div');
                videoItem.className = 'video-item';
                
                videoItem.innerHTML = `
                    <video controls>
                        <source src="${URL.createObjectURL(file)}" type="${file.type}">
                    </video>
                    <div class="video-caption">${caption || ''}</div>
                    <div class="video-actions">
                        <button onclick="changeVideo(this)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteVideo(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button onclick="editVideoCaption(this)">
                            <i class="fas fa-pen"></i>
                        </button>
                    </div>
                `;
                
                videoGrid.appendChild(videoItem);
            }
        }
        
        input.click();
    }

    const avatarEditBtn = document.querySelector('.avatar-edit-button');
    
    avatarEditBtn.addEventListener('click', function() {
        // Tạo input file ẩn
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        
        // Xử lý khi chọn file
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                // Kiểm tra kích thước file (giới hạn 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Kích thước ảnh không được vượt quá 2MB');
                    return;
                }
                
                // Kiểm tra định dạng file
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Chỉ chấp nhận file ảnh định dạng JPG, PNG hoặc GIF');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Cập nhật ảnh đại diện mới
                    document.querySelector('.avatar-image').src = e.target.result;
                    
                    // Tạo FormData để gửi file lên server
                    const formData = new FormData();
                    formData.append('avatar', file);
                    
                    // Gọi API để upload ảnh
                    fetch('/api/upload-avatar', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo thành công
                            alert('Cập nhật ảnh đại diện thành công!');
                        } else {
                            // Hiển thị lỗi nếu có
                            alert('Có lỗi xảy ra: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi upload ảnh');
                    });
                }
                reader.readAsDataURL(file);
            }
        }
        
        // Kích hoạt click để chọn file
        input.click();
    });

    function changeAvatar(input) {
        if (input.files && input.files[0]) {
            // Kiểm tra kích thước file (giới hạn 2MB)
            if (input.files[0].size > 2 * 1024 * 1024) {
                alert('Kích thước ảnh không được vượt quá 2MB');
                return;
            }
            
            // Kiểm tra định dạng file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(input.files[0].type)) {
                alert('Chỉ chấp nhận file ảnh định dạng JPG, PNG hoặc GIF');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                // Cập nhật ảnh đại diện mới
                document.querySelector('.avatar-image').src = e.target.result;
                
                // Tạo FormData để gửi file lên server
                const formData = new FormData();
                formData.append('avatar', input.files[0]);
                
                // Gọi API để upload ảnh
                fetch('/api/upload-avatar', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cập nhật ảnh đại diện thành công!');
                    } else {
                        alert('Có lỗi xảy ra: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi upload ảnh');
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
});

function openGalleryUpload(category) {
    document.getElementById(`${category}-upload`).click();
}

function handleGalleryUpload(input, category) {
    if (input.files && input.files.length > 0) {
        const files = Array.from(input.files);
        
        files.forEach(file => {
            // Kiểm tra kích thước file (giới hạn 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Kích thước ảnh không được vượt quá 2MB');
                return;
            }
            
            // Kiểm tra định dạng file
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Chỉ chấp nhận file ảnh định dạng JPG, PNG hoặc GIF');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const galleryGrid = document.getElementById(
                    category === 'personal' ? 'personal-memories' :
                    category === 'academic' ? 'academic-achievements' :
                    'extracurricular-activities'
                );

                const caption = prompt('Nhập chú thích cho ảnh:', '');
                
                const galleryItem = document.createElement('div');
                galleryItem.className = 'gallery-item';
                galleryItem.innerHTML = `
                    <img src="${e.target.result}" alt="Gallery Image">
                    <div class="image-caption">${caption || ''}</div>
                    <div class="image-actions">
                        <button onclick="editGalleryCaption(this)">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button onclick="deleteGalleryImage(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                galleryGrid.appendChild(galleryItem);
            };
            reader.readAsDataURL(file);
        });
    }
}

function editGalleryCaption(button) {
    const galleryItem = button.closest('.gallery-item');
    const captionDiv = galleryItem.querySelector('.image-caption');
    const newCaption = prompt('Chỉnh sửa chú thích:', captionDiv.textContent);
    if (newCaption !== null) {
        captionDiv.textContent = newCaption;
    }
}

function deleteGalleryImage(button) {
    if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
        button.closest('.gallery-item').remove();
    }
}

function editProfileInfo() {
    const modal = document.getElementById('editProfileModal');
    const nameInput = document.getElementById('editName');
    const jobInput = document.getElementById('editJob');
    
    // Lấy giá trị hiện tại
    nameInput.value = document.getElementById('profileName').textContent;
    jobInput.value = document.getElementById('profileJob').textContent;
    
    modal.style.display = 'block';
}

function closeEditProfileModal() {
    document.getElementById('editProfileModal').style.display = 'none';
}

function updateProfileInfo(event) {
    event.preventDefault();
    
    const newName = document.getElementById('editName').value;
    const newJob = document.getElementById('editJob').value;
    
    // Cập nhật thông tin mới
    document.getElementById('profileName').textContent = newName;
    document.getElementById('profileJob').textContent = newJob;
    
    // Đóng modal
    closeEditProfileModal();
}

// Đóng modal khi click bên ngoài
window.onclick = function(event) {
    const modal = document.getElementById('editProfileModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<div id="bioModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Giới thiệu bản thân</h2>
        <form class="bio-form">
            <div class="form-group">
                <textarea class="form-input" rows="4" placeholder="Giới thiệu ngắn gọn về bản thân..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Lưu</button>
        </form>
    </div>
</div>

<div id="detailsModal" class="modal">
    <div class="modal-content" style="width: 600px;">
        <span class="close">&times;</span>
        <h2>Chỉnh sửa thông tin chi tiết</h2>
        <form class="details-form">
            <div class="form-group">
                <label>Kinh nghiệm</label>
                <textarea class="form-input" id="experience" rows="3" placeholder="Liệt kê kinh nghiệm giảng d��y"></textarea>
            </div>
            <div class="form-group">
                <label>Kỹ năng nổi bật</label>
                <textarea class="form-input" id="skills" rows="3" placeholder="Các kỹ năng chuyên môn và kỹ năng mềm"></textarea>
            </div>
            <div class="form-group">
                <label>Thành tích</label>
                <textarea class="form-input" id="achievements" rows="3" placeholder="Các thành tích đạt được trong sự nghiệp"></textarea>
            </div>
            <div class="form-group">
                <label>Phương châm sống</label>
                <textarea class="form-input" id="motto" rows="2" placeholder="Phương châm hoặc câu nói yêu thích"></textarea>
            </div>
            <div class="form-group">
                <label>Sở thích</label>
                <div class="interests-input">
                    <input type="text" class="form-input" id="newInterest" placeholder="Nhập sở thích (nhấn Enter để thêm)">
                    <div id="interestsList" class="interests-list"></div>
                </div>
            </div>
            <div class="form-group">
                <label>Thông tin liên hệ</label>
                <input type="email" class="form-input" id="email" placeholder="Email" style="margin-bottom: 10px;">
                <input type="tel" class="form-input" id="phone" placeholder="Số điện thoại" style="margin-bottom: 10px;">
                <input type="text" class="form-input" id="social" placeholder="Facebook/Zalo/LinkedIn">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Lưu thay đổi</button>
        </form>
    </div>
</div>

<div id="interestsModal" class="modal">
    <div class="modal-content" style="width: 600px;">
        <span class="close">&times;</span>
        <h2>Thêm sở thích</h2>
        <form class="interests-form">
            <div class="form-group">
                <label>Chọn từ danh sách có sẵn</label>
                <div class="predefined-interests">
                    <div class="interest-item">
                        <input type="checkbox" id="reading" name="interests[]" value="reading">
                        <label for="reading"><i class="fas fa-book"></i> Đọc sách</label>
                    </div>
                    <div class="interest-item">
                        <input type="checkbox" id="music" name="interests[]" value="music">
                        <label for="music"><i class="fas fa-music"></i> Âm nhạc</label>
                    </div>
                    <div class="interest-item">
                        <input type="checkbox" id="sports" name="interests[]" value="sports">
                        <label for="sports"><i class="fas fa-running"></i> Thể thao</label>
                    </div>
                    <div class="interest-item">
                        <input type="checkbox" id="cooking" name="interests[]" value="cooking">
                        <label for="cooking"><i class="fas fa-utensils"></i> Nấu ăn</label>
                    </div>
                    <div class="interest-item">
                        <input type="checkbox" id="travel" name="interests[]" value="travel">
                        <label for="travel"><i class="fas fa-plane"></i> Du lịch</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Thêm sở thích khác</label>
                <div class="custom-interest-input">
                    <input type="text" class="form-input" id="newInterest" placeholder="Nhập sở thích của bạn">
                    <input type="file" id="interestImage" accept="image/*" style="display: none;">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('interestImage').click()">
                        <i class="fas fa-image"></i> Chọn ảnh
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Lưu</button>
        </form>
    </div>
</div>

<div id="transactionModal" class="modal">
    <div class="modal-content" style="width: 600px;">
        <span class="close">&times;</span>
        <h2>Thêm giao dịch mới</h2>
        <form id="transactionForm" class="transaction-form">
            <div class="form-group">
                <label>Loại giao dịch</label>
                <select class="form-input" id="transactionType" required>
                    <option value="">Chọn loại giao dịch</option>
                    <option value="tuition">Thanh toán học phí</option>
                    <option value="fund">Đóng quỹ lớp</option>
                    <option value="book">Mua sách</option>
                    <option value="other">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-input" id="transactionDesc" rows="2" required 
                    placeholder="Chi tiết về giao dịch..."></textarea>
            </div>
            <div class="form-group">
                <label>Số tiền (VNĐ)</label>
                <input type="number" class="form-input" id="transactionAmount" required
                    placeholder="Nhập số tiền...">
            </div>
            <div class="form-group">
                <label>Phương thức thanh toán</label>
                <select class="form-input" id="transactionMethod" required>
                    <option value="">Chọn phương thức</option>
                    <option value="cash">Tiền mặt</option>
                    <option value="transfer">Chuyển khoản</option>
                    <option value="ewallet">Ví điện tử</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">
                Lưu giao dịch
            </button>
        </form>
    </div>
</div>

<div id="editProfileModal" class="edit-profile-modal">
    <div class="edit-profile-content">
        <span class="close" onclick="closeEditProfileModal()">&times;</span>
        <h2>Sửa thông tin cá nhân</h2>
        <form class="edit-profile-form" onsubmit="updateProfileInfo(event)">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" id="editName" required>
            </div>
            <div class="form-group">
                <label>Nghề nghiệp</label>
                <input type="text" id="editJob" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%">Lưu thay đổi</button>
        </form>
    </div>
</div>

@endsection