<?php

function filterItemsByStoreId(array $items, $storeId)
{
  return array_filter($items, fn($item) => $item['store_id'] === $storeId);
}

function formatPriceToDatabase($price) {
  return str_replace(['.', ','], ['', '.'], $price);
}