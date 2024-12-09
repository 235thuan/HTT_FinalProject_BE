<div class="position-relative search-box">
    <input type="text" 
           id="{{ $id }}" 
           class="form-control bg-light bg-opacity-75 border-light ps-4"
           placeholder="{{ $placeholder }}"
           autocomplete="off">
    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2 search-icon"></i>
    
    <!-- Suggestions dropdown -->
    <div id="{{ $id }}-suggestions" class="suggestions-dropdown" style="display: none;">
        <div class="suggestions-list"></div>
        <div class="no-results" style="display: none;">
            <p class="text-muted p-2 mb-0">Không tìm thấy kết quả</p>
        </div>
    </div>
</div>

<style>
.search-box {
    position: relative;
}
.suggestions-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
}
.suggestion-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}
.suggestion-item:hover {
    background: #f8f9fa;
}
.suggestion-item .highlight {
    background: yellow;
    font-weight: bold;
}
</style> 