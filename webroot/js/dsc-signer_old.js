var dscSigner = (function($) {

	var signData;
	var aliasName;
	var storeData;

	var batch_size = 0;
	var batch_token;

	var isCertificateValid = false;
	var isVerified = false;

	// For Request to NICDSign Http Server
	var dscServiceUrl = "http://localhost:8019/signer";
	// For Request to NICDSign Https Server
	// var dscServiceUrl = "https://localhost:8020/signer";

	var config = {};

	function reportSigningError(message) {
		$('#panel .dsc-confirm-sign')
			.prop('disabled', false)
			.text('Confirm Signing');
		if (config.errorCallback) {
			config.errorCallback(message);
		} else {
			alert(message);
		}
	}

	var configure = function(data) {
		if (data) {
			config = data;
		} else
			alert("Incorrect configuration data.");
	};

	var gstSigner = function(data) {
		signData = data;
		var startSigning = function() {
			initialize(function() {
			listCertificatesForSigning();
			});
		};
		if (config.mode != "batch") {
			logout().always(startSigning);
		} else {
			startSigning();
		}
	};

	var getCertificate = function(callback) {

		initialize(function(data) {
			doGetCertificate(function(data) {
				callback(data);
			});
		});
	};

	function initialize(postInitCallback) {
		$
				.ajax({
					url : dscServiceUrl + "/isInitialized",
					type : "post",
					dataType : "json",
					contentType : 'application/json'
				})
				.done(function(data) {
					console.log(data);
					if (data.status === 'success') {
						storeData = data;
						if (data.storePasswordNeeded && !data.initialized) {
							doInitialize(postInitCallback);
						} else {
							doGetCertificate(postInitCallback);
						}
					} else {
						reportSigningError(data.errorMessage || 'NICDSign could not initialize.');
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					reportSigningError('Cannot connect to NICDSign ('
						+ (errorThrown || textStatus) + '). Check that the signer is running.');
				});
		return true;
	}

	function initializeBatch(size) {
		logout();
		if (size <= 0 || size > 100) {
			alert("Batch size must be between 1 and 100");
			return;
		}
		batch_size = size;
		batch_token = SHA256(makeid());
		return batch_token
	}

	var getBatchSize = function(callback) {
		return batch_size;
	};

	function doInitialize(postInitCallback) {
		$
				.ajax({
					url : dscServiceUrl + "/initialize",
					type : "post",
					dataType : "json",
					contentType : 'application/json'
				})
				.done(function(data) {
					console.log(data);
					if (data.status === 'success') {
						postInitCallback(data);
					} else {
						reportSigningError(data.errorMessage || 'NICDSign initialization failed.');
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					reportSigningError('NICDSign initialization failed ('
						+ (errorThrown || textStatus) + ').');
				});
	}

	function doGetCertificate(callback) {
		$
				.ajax({
					url : dscServiceUrl + "/getCertificate",
					type : "post",
					dataType : "json",
					contentType : 'application/json'
				})
				.done(function(data) {
					if (data.status === 'success') {
						callback(data);
					} else {
						reportSigningError(data.errorMessage || 'NICDSign could not read the certificate.');
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					reportSigningError('NICDSign certificate request failed ('
						+ (errorThrown || textStatus) + ').');
				});
	}

	function listCertificatesForSigning() {
		$
				.ajax({
					url : dscServiceUrl + "/listCertificates",
					type : "post",
					dataType : "json",
					contentType : 'application/json'
				})
				.done(
						function(data) {
							console.log("listCertificatesForSigning response:");
							console.log(data);
							if (data.status === 'success') {
								if (config.certificateSno == null
										|| config.certificateSno == '') {
									if (config.certificateData == null
											|| config.certificateData == '') {
										if (config.mode == 'nostampingnoencryptionv2') {
											selectSelfSignCertificate(data);
										} else {
											selectCertificate(data);
										}
									} else {
										var flag = false;
										for ( var i in data.certificates) {
											if (config.certificateData === data.certificates[i].certificateData) {
												doSign(
														data.certificates[i].alias,
														data.certificates[i].serialNumber,
														data.certificates[i]);
												flag = true;
											}
										}
										if (!flag) {
											alert("No token found matching the registered certificate.\nMake sure you have plugged in the correct token and try again.");
											logout();
										}
									}

								} else {
									var flag = false;
									for ( var i in data.certificates) {
										if (config.certificateSno === data.certificates[i].serialNumber) {
											doSign(
													data.certificates[i].alias,
													data.certificates[i].serialNumber,
													data.certificates[i]);
											flag = true;
										}
									}
									if (!flag) {
										alert("No token found matching the registered certificate.\nMake sure you have plugged in the correct token and try again.");
										logout();
									}
								}
							} else {
								reportSigningError(data.errorMessage || 'NICDSign could not list certificates.');
							}
						})
				.fail(function(jqXHR, textStatus, errorThrown) {
					reportSigningError('NICDSign could not list certificates ('
						+ (errorThrown || textStatus) + ').');
				});
	}

	function selectCertificate(data) {
		var panel = $('#panel').addClass("modal");
		panel.empty();
		var title = $('<h2/>').text('Certificate for Signing').addClass(
				'jumbotron text-center');
		var div = $('<div/>').append(title).addClass('well container');
		for ( var i in data.certificates) {
			var notBefore = new Date(data.certificates[i].notBefore);
			var notBeforeDate = notBefore.toString("dd-MMM-yyyy hh:mm tt");
			var notAfter = new Date(data.certificates[i].notAfter);
			var notAfterDate = notAfter.toString("dd-MMM-yyyy hh:mm tt");
			div
					.append("<table class='table table-bordered table-striped table-hover table-condensed table-responsive center-block' style='width:60%;'>"
							+ "<tbody>"
							+ "<tr><td>Name</td><td style='text-align:left;'>"
							+ data.certificates[i].alias
							+ "</td></tr>"
							+ "<tr><td>Issuer</td><td style='text-align:left;'>"
							+ data.certificates[i].issuer
							+ "</td></tr>"
							+ "<tr><td style='width:100px;'>Valid From</td><td style='text-align:left;'>"
							+ notBeforeDate
							+ "</td></tr>"
							+ "<tr><td>Valid To</td><td style='text-align:left;'>"
							+ notAfterDate
							+ "</td></tr>"
							+ "</tbody>"
							+ "</table>");
			var confirmButton = $('<button/>', {
				type : 'button'
			}).text('Confirm Signing').addClass('btn btn-success dsc-confirm-sign')
				.on('click', { certificate : data.certificates[i] }, function(event) {
					var certificate = event.data.certificate;
					$(this).prop('disabled', true).text('Checking certificate...');
					window.requestAnimationFrame(function() {
						console.log("Signing with certificate:", certificate.alias);
						dscSigner.doSign(certificate.alias, certificate.serialNumber,
							certificate.certificateData);
					});
				});
			div.append($('<br><div>').append(confirmButton));
		}
		panel.append(div);
		panel.show();
		var closeBtn = "<button onclick='hidePanel()' class='btn btn-default' style='position:fixed;z-index:99;right:20px;top:20px'>Close</button>"
		$("#panel").append(closeBtn);
	}

	function selectSelfSignCertificate(data) {
		for ( var i in data.certificates) {
			dscSigner.doSign(data.certificates[i].alias,
					data.certificates[i].serialNumber,
					data.certificates[i].certificateData);
		}
	}

	function doVerifyCertificate(callback) {
		isCertificateValid = false;
		var certificateData = config.certificateData;
		var data = {
			action : "VERIFY",
			cert_data : certificateData
		};
		var reportError = function(message) {
			isCertificateValid = false;
			reportSigningError(message);
			if (callback) callback(false);
		};
		$.ajax({
			url : dscapibaseurl + "/certificate",
			type : "post",
			dataType : "json",
			contentType : 'application/json',
			data : JSON.stringify(data)
		}).done(function(data) {
			console.log("Certificate verification response:");
			console.log(data);
			if (Number(data.status_cd) === 1) {
				try {
					var verification = JSON.parse(atob(data.data));
					if (verification.isvalid === 'Y') {
						isCertificateValid = true;
						if (callback) callback(true);
						return;
					}
					logout();
					reportError(atob(data.data));
				} catch (error) {
					reportError('NICDSign returned an unreadable certificate verification response.');
				}
			} else {
				reportError(data.error && data.error.message
					? data.error.message
					: 'NICDSign could not verify the DSC certificate.');
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			if (jqXHR.status === 0) {
				reportError('Cannot reach the NICDSign certificate API at '
					+ dscapibaseurl + '/certificate. Check that the NICDSign API is running and the API URL is correct.');
				return;
			}
			reportError('NICDSign certificate verification failed (HTTP '
				+ jqXHR.status + ': ' + (errorThrown || textStatus) + ').');
		});
	}

	function doSign(alias, serialNumber, certificate) {
		if (config.certificateData == null || config.certificateData == "") {
			config.certificateData = certificate;
		}
		// Verify the certificate before signing without blocking the page.
		doVerifyCertificate(function(isValid) {
			if (!isValid) return;
			var preSignResult = config.preSignCallback
				? config.preSignCallback()
				: true;
			if (!preSignResult) {
				$('#panel .dsc-confirm-sign').prop('disabled', false)
					.text('Confirm Signing');
				return;
			}
			$('#panel .dsc-confirm-sign:disabled').text('Signing...');
			aliasName = alias;
			console.log("Signing with alias:", aliasName, "serialNumber:", serialNumber,"signType",config.signType,"mode",config.mode);
			if (config.signType === 'data') {
				realSign(signData);
			} else if (config.signType === 'xml') {
				realSignXML(signData);
			} else if (config.signType === 'pdf') {
				if (config.mode === 'stamping') {
					realSignPdfStamping(signData);
				} else if (config.mode === 'nostampingv2') {
					PDFNoStampingV2(signData);
				} else if (config.mode === 'nostampingv3') {
					PDFNoStampingV3(signData);
				} else if (config.mode === 'batch') {
					PDFNoStampingBatchV2(signData);
				} else if (config.mode === 'nostampingnoencryptionv2') {
					realSignPdfNoStampingNoEncryption(signData);
				} else {
					realSignPdfNoStamping(signData);
				}
		}
		});
	}

	function realSign(signData) {
		try {
			var data = {
				data : btoa(signData),
				type : 'SHA256withRSA',
				alias : aliasName
			};
		} catch (err) {
			var data = {
				data : utoa(signData),
				type : 'SHA256withRSA',
				alias : aliasName
			};
		}
		$
				.ajax({
					url : dscServiceUrl + "/sign",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {
							logout();
							if (data.status === 'success') {
								$('#panel').hide();
								if (config.postSignCallback)
									config.postSignCallback(aliasName,
											data.sign, data.token);
							} else {
								alert(data.errorMessage);
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("NICDign is not installed or running 5");
							logout();
						});
	}

	function realSignXML(signData) {
		if (hasSignatureNode(signData)) {
			try {
				var data = {
					action : 'VERIFY',
					en_sig : btoa(signData)
				};
			} catch (err) {
				var data = {
					action : 'VERIFY',
					en_sig : utoa(signData)
				};
			}
			$.ajax({
						url : dscapibaseurl + "/xmlsignature",
						type : "post",
						dataType : "json",
						contentType : 'application/json',
						data : JSON.stringify(data),
						async : false
					})
					.done(function(data) {
						if (data.status_cd == 1) {
							var jsonData = JSON.parse(atob(data.data))
							if (jsonData.isVerified == true) {
								isVerified = true;
								if(isVerified){
									try {
										var data = {
											data : btoa(signData),
											alias : aliasName
										};
									} catch (err) {
										var data = {
											data : utoa(signData),
											alias : aliasName
										};
									}
									$.ajax({
												url : dscServiceUrl + "/signXMLData",
												type : "post",
												dataType : "json",
												contentType : 'application/json',
												data : JSON.stringify(data),
												async : false
											})
											.done(function(data) {
														logout();
														if (data.status === 'success') {
															$('#panel').hide();
															if (config.postSignCallback)
																config.postSignCallback(aliasName,
																		data.sign, data.token);
														} else {
															alert(data.errorMessage);
														}
													})
											.fail(function(jqXHR, textStatus, errorThrown) {
														alert("NICDign is not installed or running 6");
														logout();
													});
								}else{
									alert("XML Signature Verification failed.");
									return false;
								}
							} else {
								alert("XML Signature Verification failed.");
								isVerified = false;
								return false;
							}
						} else {
							isVerified = false;
							return false;
						}
					})
					.fail(
							function(jqXHR, textStatus, errorThrown) {
								alert("XML Signature Verification failed.Please Check DSCApi Service accessible or not");
							});
		} else {
			try {
				var data = {
					data : btoa(signData),
					alias : aliasName
				};
			} catch (err) {
				var data = {
					data : utoa(signData),
					alias : aliasName
				};
			}
			$
					.ajax({
						url : dscServiceUrl + "/signXMLData",
						type : "post",
						dataType : "json",
						contentType : 'application/json',
						data : JSON.stringify(data),
						async : false
					})
					.done(
							function(data) {
								logout();
								if (data.status === 'success') {
									$('#panel').hide();
									if (config.postSignCallback)
										config.postSignCallback(aliasName,
												data.sign, data.token);
								} else {
									alert(data.errorMessage);
								}
							})
					.fail(
							function(jqXHR, textStatus, errorThrown) {
								alert("NICDign is not installed or running 7");
								logout();
							});
		}

	}

	function realSignPdfNoStamping(signData) {
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val()
		};

		console.log('Signing PDF with NICDSign, alias:', aliasName, 'reason:', data.reason, 'location:', data.location, 'tsaURL:', data.tsaURL, 'timeServerURL:', data.timeServerURL);
		$
				.ajax({
					url : dscServiceUrl + "/signPdfNoStamping",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {

                             console.log('NICDSign signing response status:', data?.status);
                             console.log('NICDSign response field names:', Object.keys(data || {}));

							logout();
							if (data.status === 'success') {
								$('#panel').hide();
								var signedPdf = data.signedPdf || data.base64Data
									|| data.pdfdocument || data.data;
								if (typeof signedPdf !== 'string' || signedPdf.trim() === '') {
									var message = data.errorMessage || data.message
										|| 'NICDSign returned success without PDF data. Response fields: '
										+ Object.keys(data).join(', ');
									if (config.errorCallback) {
										config.errorCallback(message);
									} else {
										alert(message);
									}
									return;
								}
								if (config.postSignCallback) {
									config.postSignCallback(aliasName, signedPdf, data.token);
								}
							} else {
								var message = data.errorMessage || data.message
									|| 'NICDSign could not sign the PDF.';
								if (config.errorCallback) {
									config.errorCallback(message);
								} else {
									alert(message);
								}
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("NICDign is not installed or running 8");
							logout();
						});
	}

	function realSignPdfNoStampingNoEncryption(signData) {
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val()
		};
		console.log('Signing PDF with NICDSign (no stamping, no encryption), alias:', aliasName, 'reason:', data.reason, 'location:', data.location, 'tsaURL:', data.tsaURL, 'timeServerURL:', data.timeServerURL);
		$
				.ajax({
					url : dscServiceUrl + "/PDFNoStampingNoEncryptionV2",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {
							console.log('NICDSign signing response status:', data?.status);
							console.log('NICDSign signing response data:', data);
							logout();
							if (data.status === 'success') {
								$('#panel').hide();
								if (config.postSignCallback)
									config.postSignCallback(aliasName,
											data.signedPdf, data.token);
							} else {
								alert(data.errorMessage);
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("NICDign is not installed or running 9");
							logout();
						});
	}

	function signPDFBatch(signData, token) {
		// Verify batch token
		if (token != batch_token) {
			alert("Invalid batch token");
			return;
		}

		// Logout after end of batch
		if (batch_size == 0) {
			alert("Batch terminated!");
			return;
		}
		gstSigner(signData);

	}

	function PDFNoStampingBatchV2(signData) {

		var StampingObject = new Object();
		StampingObject.stampingX = $('#stampingX').val();
		StampingObject.stampingY = $('#stampingY').val();
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val(),
			stampingData : StampingObject
		};
		console.log('Signing PDF batch with NICDSign (no stamping), alias:', aliasName, 'reason:', data.reason, 'location:', data.location, 'tsaURL:', data.tsaURL, 'timeServerURL:', data.timeServerURL);
		console.log('Stamping data:', data.stampingData);
		$
				.ajax({
					url : dscServiceUrl + "/PDFNoStampingV2",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {
							console.log('NICDSign signing response status:', data?.status);
							console.log('NICDSign signing response data:', data);
							if (data.status === 'success') {
								$('#panel').hide();
								if (config.postSignCallback)
									config.postSignCallback(aliasName,
											data.signedPdf, data.token);
								batch_size = batch_size - 1;
								// Logout after end of batch
								if (batch_size == 0) {
									logout();

								}
							} else {
								alert(data.errorMessage);
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("DSCSigner client is not installed or running.If DSCSigner client is already installed, \nremove and reconnect the token before trying again.");
							logout();
						});
	}

	function PDFNoStampingV2(signData) {
		var StampingObject = new Object();
		StampingObject.stampingX = $('#stampingX').val();
		StampingObject.stampingY = $('#stampingY').val();
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val(),
			stampingData : StampingObject
		};
		console.log('Signing PDF with NICDSign (no stamping), alias:', aliasName, 'reason:', data.reason, 'location:', data.location, 'tsaURL:', data.tsaURL, 'timeServerURL:', data.timeServerURL);

		$
				.ajax({
					url : dscServiceUrl + "/PDFNoStampingV2",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data)
				})
				.done(
						function(data) {
							console.log('NICDSign signing response status:', data?.status);
							console.log('NICDSign response fields:', Object.keys(data || {}));
							if (data.status === 'success') {
								var signedPdf = data.signedPdf || data.sign || data.data;
								var encryptionKey = data.token || data.key || data.encryptedKey;
								console.log('NICDSign PDF payload length:', typeof signedPdf === 'string' ? signedPdf.length : 0);
								if (typeof signedPdf !== 'string' || !signedPdf
										|| typeof encryptionKey !== 'string' || !encryptionKey) {
									console.error('NICDSign PDF response is missing signed PDF or encryption key. Fields:', Object.keys(data || {}));
									reportSigningError('NICDSign reported success but did not return the signed PDF and encryption key. Check the signer response fields.');
									logout();
									return;
								}
								if (config.postSignCallback) {
									config.postSignCallback(aliasName, signedPdf, encryptionKey);
								} else {
									reportSigningError('No callback is configured to receive the signed PDF.');
								}
								logout();
							} else {
								reportSigningError(data.errorMessage || 'NICDSign could not sign the PDF.');
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							reportSigningError('NICDSign PDF signing failed ('
								+ (errorThrown || textStatus) + ').');
							logout();
						});
	}
	
	function PDFNoStampingV3(signData) {
		var StampingObject = new Object();
		StampingObject.stampingX = $('#stampingX').val();
		StampingObject.stampingY = $('#stampingY').val();
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val(),
			pageNo : $('#pageNo').val(),
			stampingData : StampingObject
		};
		$
				.ajax({
					url : dscServiceUrl + "/PDFNoStampingV3",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {
							logout();
							if (data.status === 'success') {
								$('#panel').hide();
								if (config.postSignCallback)
									config.postSignCallback(aliasName,
											data.signedPdf, data.token);
							} else {
								alert(data.errorMessage);
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("NICDign is not installed or running 11");
							logout();
						});
	}

	function realSignPdfStamping(signData) {
		var StampingObject = new Object();
		// StampingObject.mode = $('input[name=stampingMode]:checked').val();
		if ($('#allPageMode').is(':checked')) {
			StampingObject.mode = "A";
		} else if ($('#lastPageMode').is(':checked')) {
			StampingObject.mode = "L";
		} else {
			StampingObject.mode = "L";
		}
		StampingObject.stampingX = $('#stampingX').val();
		StampingObject.stampingY = $('#stampingY').val();
		StampingObject.scale = $('#scale').val();
		StampingObject.stampingImageData = $('#imageData').val();
		var data = {
			base64PdfData : signData,
			alias : aliasName,
			reason : $('#signingReason').val(),
			location : $('#signingLocation').val(),
			tsaURL : $('#tsaURL').val(),
			timeServerURL : $('#timeServerURL').val(),
			stampingData : StampingObject
		};
		console.log('Signing PDF with NICDSign (stamping), alias:', aliasName, 'reason:', data.reason, 'location:', data.location, 'tsaURL:', data.tsaURL, 'timeServerURL:', data.timeServerURL);
		console.log('Stamping data:', data.stampingData);
		$
				.ajax({
					url : dscServiceUrl + "/signPdfStamping",
					type : "post",
					dataType : "json",
					contentType : 'application/json',
					data : JSON.stringify(data),
					async : false
				})
				.done(
						function(data) {
							console.log('NICDSign signing response status:', data?.status);
							console.log('NICDSign signing response data:', data);
							logout();
							if (data.status === 'success') {
								$('#panel').hide();
								if (config.postSignCallback)
									config.postSignCallback(aliasName,
											data.signedPdf, data.token);
							} else {
								alert(data.errorMessage);
							}
						})
				.fail(
						function(jqXHR, textStatus, errorThrown) {
							alert("NICDign is not installed or running 12");
							logout();
						});
	}

	function logout() {
		return $.ajax({
					url : dscServiceUrl + "/logout",
					type : "post",
					dataType : "json",
					contentType : 'application/json'
				})
	}

	// ucs-2 string to base64 encoded ascii
	function utoa(str) {
		return window.btoa(unescape(encodeURIComponent(str)));
	}
	// base64 encoded ascii to ucs-2 string
	function atou(str) {
		return decodeURIComponent(escape(window.atob(str)));
	}

	function hasSignatureNode(xmlData) {
		var $xmlDoc = $(xmlData);
		var el = $xmlDoc.find('Signature');
		if (el && el.length > 0) {
			return true
		} else {
			return false
		}
	}

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible
					.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}

	function SHA256(s) {
		var chrsz = 8;
		var hexcase = 0;
		function safe_add(x, y) {
			var lsw = (x & 0xFFFF) + (y & 0xFFFF);
			var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
			return (msw << 16) | (lsw & 0xFFFF);
		}
		function S(X, n) {
			return (X >>> n) | (X << (32 - n));
		}
		function R(X, n) {
			return (X >>> n);
		}
		function Ch(x, y, z) {
			return ((x & y) ^ ((~x) & z));
		}
		function Maj(x, y, z) {
			return ((x & y) ^ (x & z) ^ (y & z));
		}
		function Sigma0256(x) {
			return (S(x, 2) ^ S(x, 13) ^ S(x, 22));
		}
		function Sigma1256(x) {
			return (S(x, 6) ^ S(x, 11) ^ S(x, 25));
		}
		function Gamma0256(x) {
			return (S(x, 7) ^ S(x, 18) ^ R(x, 3));
		}
		function Gamma1256(x) {
			return (S(x, 17) ^ S(x, 19) ^ R(x, 10));
		}
		function core_sha256(m, l) {
			var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5,
					0x3956C25B, 0x59F111F1, 0x923F82A4, 0xAB1C5ED5, 0xD807AA98,
					0x12835B01, 0x243185BE, 0x550C7DC3, 0x72BE5D74, 0x80DEB1FE,
					0x9BDC06A7, 0xC19BF174, 0xE49B69C1, 0xEFBE4786, 0xFC19DC6,
					0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA,
					0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3,
					0xD5A79147, 0x6CA6351, 0x14292967, 0x27B70A85, 0x2E1B2138,
					0x4D2C6DFC, 0x53380D13, 0x650A7354, 0x766A0ABB, 0x81C2C92E,
					0x92722C85, 0xA2BFE8A1, 0xA81A664B, 0xC24B8B70, 0xC76C51A3,
					0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070, 0x19A4C116,
					0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A,
					0x5B9CCA4F, 0x682E6FF3, 0x748F82EE, 0x78A5636F, 0x84C87814,
					0x8CC70208, 0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);
			var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372,
					0xA54FF53A, 0x510E527F, 0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);
			var W = new Array(64);
			var a, b, c, d, e, f, g, h, i, j;
			var T1, T2;
			m[l >> 5] |= 0x80 << (24 - l % 32);
			m[((l + 64 >> 9) << 4) + 15] = l;
			for (var i = 0; i < m.length; i += 16) {
				a = HASH[0];
				b = HASH[1];
				c = HASH[2];
				d = HASH[3];
				e = HASH[4];
				f = HASH[5];
				g = HASH[6];
				h = HASH[7];
				for (var j = 0; j < 64; j++) {
					if (j < 16)
						W[j] = m[j + i];
					else
						W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]),
								W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);
					T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)),
							Ch(e, f, g)), K[j]), W[j]);
					T2 = safe_add(Sigma0256(a), Maj(a, b, c));
					h = g;
					g = f;
					f = e;
					e = safe_add(d, T1);
					d = c;
					c = b;
					b = a;
					a = safe_add(T1, T2);
				}
				HASH[0] = safe_add(a, HASH[0]);
				HASH[1] = safe_add(b, HASH[1]);
				HASH[2] = safe_add(c, HASH[2]);
				HASH[3] = safe_add(d, HASH[3]);
				HASH[4] = safe_add(e, HASH[4]);
				HASH[5] = safe_add(f, HASH[5]);
				HASH[6] = safe_add(g, HASH[6]);
				HASH[7] = safe_add(h, HASH[7]);
			}
			return HASH;
		}
		function str2binb(str) {
			var bin = Array();
			var mask = (1 << chrsz) - 1;
			for (var i = 0; i < str.length * chrsz; i += chrsz) {
				bin[i >> 5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i % 32);
			}
			return bin;
		}
		function Utf8Encode(string) {
			string = string.replace(/\r\n/g, "\n");
			var utftext = "";
			for (var n = 0; n < string.length; n++) {
				var c = string.charCodeAt(n);
				if (c < 128) {
					utftext += String.fromCharCode(c);
				} else if ((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				} else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}
			}
			return utftext;
		}
		function binb2hex(binarray) {
			var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
			var str = "";
			for (var i = 0; i < binarray.length * 4; i++) {
				str += hex_tab
						.charAt((binarray[i >> 2] >> ((3 - i % 4) * 8 + 4)) & 0xF)
						+ hex_tab
								.charAt((binarray[i >> 2] >> ((3 - i % 4) * 8)) & 0xF);
			}
			return str;
		}
		s = Utf8Encode(s);
		return binb2hex(core_sha256(str2binb(s), s.length * chrsz));
	}

	return {
		configure : configure,
		certificate : getCertificate,
		initialize : initialize,
		sign : gstSigner,
		doSign : doSign,
		logout : logout,
		initbatch : initializeBatch,
		signpdfbatch : signPDFBatch,
		batchsize : getBatchSize
	}
}(jQuery));

function hidePanel() {
	$("#panel").hide();
	if (window.dscSigner && typeof window.dscSigner.logout === 'function') {
		window.dscSigner.logout();
	}
}
