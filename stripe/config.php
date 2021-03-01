<?php
require_once('init.php');

$stripe = [
  "secret_key"      => "sk_test_51I1J1sJdMRrsWnvn6r8nczr25fB2zT3b0P8Hlexx1ykeSgGjtJidsY92PHKDH45cqSzWwBfqPqQOfLXyf7WrLOFP00MhyvUfZ7",
  "publishable_key" => "pk_test_51I1J1sJdMRrsWnvnQLZF0nkgyyLOKVA2RQMiNuE07Sj6JxYkZQjZZXJSeUjIdCfct5jFMgS943JwimoVCc71GQx300D2WTjd0a",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>