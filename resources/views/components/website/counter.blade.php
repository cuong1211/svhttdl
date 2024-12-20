<div class="visitor-stats">
    <div class="stat-item">
        <div class="stat-label">Đang online:</div>
        <div class="stat-value">{{ $current }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Hôm nay:</div>
        <div class="stat-value">{{ $today }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Tháng này:</div>
        <div class="stat-value">{{ $month }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Tổng lượt truy cập:</div>
        <div class="stat-value">{{ $total }}</div>
    </div>
</div>

<style>
.visitor-stats {
    float: right;
    padding: 10px;
    font-family: Arial, sans-serif;
}

.stat-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #fff;
}

.stat-label {
    font-size: 13px;
    margin-right: 5px;
}

.stat-value {
    font-weight: bold;
    font-size: 13px;
}

/* Hover effect */
/* Responsive */
@media (max-width: 768px) {
    .visitor-stats {
        float: none;
        width: 100%;
    }
    
    .stat-item {
        justify-content: center;
    }
}
</style>