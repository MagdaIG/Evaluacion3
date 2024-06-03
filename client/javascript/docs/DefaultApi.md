# ApiDeEnergyAndWater.DefaultApi

All URIs are relative to */*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addCategoriaServicio**](DefaultApi.md#addCategoriaServicio) | **POST** /v1/categoria_servicio | Agregar una nueva categoría de servicio
[**addEquipo**](DefaultApi.md#addEquipo) | **POST** /v1/equipo | Agregar un nuevo equipo
[**addHistoria**](DefaultApi.md#addHistoria) | **POST** /v1/historia | Agregar una nueva historia
[**addInfoContacto**](DefaultApi.md#addInfoContacto) | **POST** /v1/info_contacto | Agregar nueva información de contacto
[**addMantenimientoInfo**](DefaultApi.md#addMantenimientoInfo) | **POST** /v1/mantenimiento_info | Agregar nueva información de mantenimiento
[**createPreguntaFrecuente**](DefaultApi.md#createPreguntaFrecuente) | **POST** /v1/pregunta_frecuente | Agregar nueva pregunta frecuente
[**deleteCategoriaServicioById**](DefaultApi.md#deleteCategoriaServicioById) | **DELETE** /v1/categoria_servicio/{id} | Eliminar una categoría de servicio por ID
[**deleteEquipo**](DefaultApi.md#deleteEquipo) | **DELETE** /v1/equipo/{id} | Eliminar un equipo por ID
[**deleteHistoria**](DefaultApi.md#deleteHistoria) | **DELETE** /v1/historia/{id} | Eliminar una historia por ID
[**deleteInfoContacto**](DefaultApi.md#deleteInfoContacto) | **DELETE** /v1/info_contacto/{id} | Eliminar información de contacto por ID
[**deleteMantenimientoInfo**](DefaultApi.md#deleteMantenimientoInfo) | **DELETE** /v1/mantenimiento_info/{id} | Eliminar información de mantenimiento por ID
[**deletePreguntaFrecuente**](DefaultApi.md#deletePreguntaFrecuente) | **DELETE** /v1/pregunta_frecuente/{id} | Eliminar una pregunta frecuente por ID
[**getAllCategoriasServicio**](DefaultApi.md#getAllCategoriasServicio) | **GET** /v1/categoria_servicio | Obtener todas las categorías de servicio
[**getAllEquipos**](DefaultApi.md#getAllEquipos) | **GET** /v1/equipo | Obtener todos los equipos
[**getAllHistorias**](DefaultApi.md#getAllHistorias) | **GET** /v1/historia | Obtener todas las historias
[**getAllInfoContacto**](DefaultApi.md#getAllInfoContacto) | **GET** /v1/info_contacto | Obtener toda la información de contacto
[**getAllMantenimientoInfo**](DefaultApi.md#getAllMantenimientoInfo) | **GET** /v1/mantenimiento_info | Obtener toda la información de mantenimiento
[**getAllPreguntasFrecuentes**](DefaultApi.md#getAllPreguntasFrecuentes) | **GET** /v1/pregunta_frecuente | Obtener todas las preguntas frecuentes
[**getCategoriaServicioById**](DefaultApi.md#getCategoriaServicioById) | **GET** /v1/categoria_servicio/{id} | Obtener una categoría de servicio por ID
[**getEquipoById**](DefaultApi.md#getEquipoById) | **GET** /v1/equipo/{id} | Obtener un equipo por ID
[**getHistoriaById**](DefaultApi.md#getHistoriaById) | **GET** /v1/historia/{id} | Obtener una historia por ID
[**getInfoContactoById**](DefaultApi.md#getInfoContactoById) | **GET** /v1/info_contacto/{id} | Obtener información de contacto por ID
[**getMantenimientoInfoById**](DefaultApi.md#getMantenimientoInfoById) | **GET** /v1/mantenimiento_info/{id} | Obtener información de mantenimiento por ID
[**getPreguntaFrecuenteById**](DefaultApi.md#getPreguntaFrecuenteById) | **GET** /v1/pregunta_frecuente/{id} | Obtener una pregunta frecuente por ID
[**partialUpdateCategoriaServicio**](DefaultApi.md#partialUpdateCategoriaServicio) | **PATCH** /v1/categoria_servicio/{id} | Actualizar parcialmente una categoría de servicio
[**partialUpdateEquipo**](DefaultApi.md#partialUpdateEquipo) | **PATCH** /v1/equipo/{id} | Actualizar parcialmente un equipo
[**partialUpdateHistoria**](DefaultApi.md#partialUpdateHistoria) | **PATCH** /v1/historia/{id} | Actualizar parcialmente una historia
[**partialUpdateInfoContacto**](DefaultApi.md#partialUpdateInfoContacto) | **PATCH** /v1/info_contacto/{id} | Actualizar parcialmente información de contacto por ID
[**partialUpdateMantenimientoInfo**](DefaultApi.md#partialUpdateMantenimientoInfo) | **PATCH** /v1/mantenimiento_info/{id} | Actualizar parcialmente información de mantenimiento por ID
[**partialUpdatePreguntaFrecuente**](DefaultApi.md#partialUpdatePreguntaFrecuente) | **PATCH** /v1/pregunta_frecuente/{id} | Actualizar parcialmente una pregunta frecuente por ID
[**updateHistoria**](DefaultApi.md#updateHistoria) | **PUT** /v1/historia/{id} | Actualizar o crear una historia
[**updateInfoContacto**](DefaultApi.md#updateInfoContacto) | **PUT** /v1/info_contacto/{id} | Actualizar o crear información de contacto por ID
[**updateMantenimientoInfo**](DefaultApi.md#updateMantenimientoInfo) | **PUT** /v1/mantenimiento_info/{id} | Actualizar o crear información de mantenimiento por ID
[**updateOrCreateCategoriaServicio**](DefaultApi.md#updateOrCreateCategoriaServicio) | **PUT** /v1/categoria_servicio/{id} | Actualizar o crear una categoría de servicio
[**updateOrCreateEquipo**](DefaultApi.md#updateOrCreateEquipo) | **PUT** /v1/equipo/{id} | Actualizar o crear un equipo
[**updatePreguntaFrecuente**](DefaultApi.md#updatePreguntaFrecuente) | **PUT** /v1/pregunta_frecuente/{id} | Actualizar o crear una pregunta frecuente por ID

<a name="addCategoriaServicio"></a>
# **addCategoriaServicio**
> addCategoriaServicio(body)

Agregar una nueva categoría de servicio

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1CategoriaServicioBody(); // V1CategoriaServicioBody | 

apiInstance.addCategoriaServicio(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1CategoriaServicioBody**](V1CategoriaServicioBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="addEquipo"></a>
# **addEquipo**
> addEquipo(body)

Agregar un nuevo equipo

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1EquipoBody(); // V1EquipoBody | 

apiInstance.addEquipo(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1EquipoBody**](V1EquipoBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="addHistoria"></a>
# **addHistoria**
> addHistoria(body)

Agregar una nueva historia

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1HistoriaBody(); // V1HistoriaBody | 

apiInstance.addHistoria(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1HistoriaBody**](V1HistoriaBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="addInfoContacto"></a>
# **addInfoContacto**
> addInfoContacto(body)

Agregar nueva información de contacto

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1InfoContactoBody(); // V1InfoContactoBody | 

apiInstance.addInfoContacto(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1InfoContactoBody**](V1InfoContactoBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="addMantenimientoInfo"></a>
# **addMantenimientoInfo**
> addMantenimientoInfo(body)

Agregar nueva información de mantenimiento

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1MantenimientoInfoBody(); // V1MantenimientoInfoBody | 

apiInstance.addMantenimientoInfo(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1MantenimientoInfoBody**](V1MantenimientoInfoBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="createPreguntaFrecuente"></a>
# **createPreguntaFrecuente**
> createPreguntaFrecuente(body)

Agregar nueva pregunta frecuente

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.V1PreguntaFrecuenteBody(); // V1PreguntaFrecuenteBody | 

apiInstance.createPreguntaFrecuente(body, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**V1PreguntaFrecuenteBody**](V1PreguntaFrecuenteBody.md)|  | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="deleteCategoriaServicioById"></a>
# **deleteCategoriaServicioById**
> deleteCategoriaServicioById(id)

Eliminar una categoría de servicio por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la categoría de servicio

apiInstance.deleteCategoriaServicioById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la categoría de servicio | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="deleteEquipo"></a>
# **deleteEquipo**
> deleteEquipo(id)

Eliminar un equipo por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID del equipo

apiInstance.deleteEquipo(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID del equipo | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="deleteHistoria"></a>
# **deleteHistoria**
> deleteHistoria(id)

Eliminar una historia por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la historia

apiInstance.deleteHistoria(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la historia | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="deleteInfoContacto"></a>
# **deleteInfoContacto**
> deleteInfoContacto(id)

Eliminar información de contacto por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la información de contacto

apiInstance.deleteInfoContacto(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la información de contacto | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="deleteMantenimientoInfo"></a>
# **deleteMantenimientoInfo**
> deleteMantenimientoInfo(id)

Eliminar información de mantenimiento por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la información de mantenimiento

apiInstance.deleteMantenimientoInfo(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la información de mantenimiento | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="deletePreguntaFrecuente"></a>
# **deletePreguntaFrecuente**
> deletePreguntaFrecuente(id)

Eliminar una pregunta frecuente por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la pregunta frecuente

apiInstance.deletePreguntaFrecuente(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la pregunta frecuente | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllCategoriasServicio"></a>
# **getAllCategoriasServicio**
> getAllCategoriasServicio()

Obtener todas las categorías de servicio

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllCategoriasServicio((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllEquipos"></a>
# **getAllEquipos**
> getAllEquipos()

Obtener todos los equipos

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllEquipos((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllHistorias"></a>
# **getAllHistorias**
> getAllHistorias()

Obtener todas las historias

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllHistorias((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllInfoContacto"></a>
# **getAllInfoContacto**
> getAllInfoContacto()

Obtener toda la información de contacto

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllInfoContacto((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllMantenimientoInfo"></a>
# **getAllMantenimientoInfo**
> getAllMantenimientoInfo()

Obtener toda la información de mantenimiento

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllMantenimientoInfo((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getAllPreguntasFrecuentes"></a>
# **getAllPreguntasFrecuentes**
> getAllPreguntasFrecuentes()

Obtener todas las preguntas frecuentes

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
apiInstance.getAllPreguntasFrecuentes((error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getCategoriaServicioById"></a>
# **getCategoriaServicioById**
> getCategoriaServicioById(id)

Obtener una categoría de servicio por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la categoría de servicio

apiInstance.getCategoriaServicioById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la categoría de servicio | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getEquipoById"></a>
# **getEquipoById**
> getEquipoById(id)

Obtener un equipo por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID del equipo

apiInstance.getEquipoById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID del equipo | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getHistoriaById"></a>
# **getHistoriaById**
> getHistoriaById(id)

Obtener una historia por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la historia

apiInstance.getHistoriaById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la historia | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getInfoContactoById"></a>
# **getInfoContactoById**
> getInfoContactoById(id)

Obtener información de contacto por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la información de contacto

apiInstance.getInfoContactoById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la información de contacto | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getMantenimientoInfoById"></a>
# **getMantenimientoInfoById**
> getMantenimientoInfoById(id)

Obtener información de mantenimiento por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la información de mantenimiento

apiInstance.getMantenimientoInfoById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la información de mantenimiento | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="getPreguntaFrecuenteById"></a>
# **getPreguntaFrecuenteById**
> getPreguntaFrecuenteById(id)

Obtener una pregunta frecuente por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let id = 56; // Number | ID de la pregunta frecuente

apiInstance.getPreguntaFrecuenteById(id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **Number**| ID de la pregunta frecuente | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

<a name="partialUpdateCategoriaServicio"></a>
# **partialUpdateCategoriaServicio**
> partialUpdateCategoriaServicio(body, id)

Actualizar parcialmente una categoría de servicio

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.CategoriaServicioIdBody1(); // CategoriaServicioIdBody1 | 
let id = 56; // Number | ID de la categoría de servicio

apiInstance.partialUpdateCategoriaServicio(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**CategoriaServicioIdBody1**](CategoriaServicioIdBody1.md)|  | 
 **id** | **Number**| ID de la categoría de servicio | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="partialUpdateEquipo"></a>
# **partialUpdateEquipo**
> partialUpdateEquipo(body, id)

Actualizar parcialmente un equipo

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.EquipoIdBody1(); // EquipoIdBody1 | 
let id = 56; // Number | ID del equipo

apiInstance.partialUpdateEquipo(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**EquipoIdBody1**](EquipoIdBody1.md)|  | 
 **id** | **Number**| ID del equipo | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="partialUpdateHistoria"></a>
# **partialUpdateHistoria**
> partialUpdateHistoria(body, id)

Actualizar parcialmente una historia

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.HistoriaIdBody1(); // HistoriaIdBody1 | 
let id = 56; // Number | ID de la historia

apiInstance.partialUpdateHistoria(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**HistoriaIdBody1**](HistoriaIdBody1.md)|  | 
 **id** | **Number**| ID de la historia | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="partialUpdateInfoContacto"></a>
# **partialUpdateInfoContacto**
> partialUpdateInfoContacto(body, id)

Actualizar parcialmente información de contacto por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.InfoContactoIdBody1(); // InfoContactoIdBody1 | 
let id = 56; // Number | ID de la información de contacto

apiInstance.partialUpdateInfoContacto(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**InfoContactoIdBody1**](InfoContactoIdBody1.md)|  | 
 **id** | **Number**| ID de la información de contacto | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="partialUpdateMantenimientoInfo"></a>
# **partialUpdateMantenimientoInfo**
> partialUpdateMantenimientoInfo(body, id)

Actualizar parcialmente información de mantenimiento por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.MantenimientoInfoIdBody1(); // MantenimientoInfoIdBody1 | 
let id = 56; // Number | ID de la información de mantenimiento

apiInstance.partialUpdateMantenimientoInfo(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**MantenimientoInfoIdBody1**](MantenimientoInfoIdBody1.md)|  | 
 **id** | **Number**| ID de la información de mantenimiento | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="partialUpdatePreguntaFrecuente"></a>
# **partialUpdatePreguntaFrecuente**
> partialUpdatePreguntaFrecuente(body, id)

Actualizar parcialmente una pregunta frecuente por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.PreguntaFrecuenteIdBody1(); // PreguntaFrecuenteIdBody1 | 
let id = 56; // Number | ID de la pregunta frecuente

apiInstance.partialUpdatePreguntaFrecuente(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**PreguntaFrecuenteIdBody1**](PreguntaFrecuenteIdBody1.md)|  | 
 **id** | **Number**| ID de la pregunta frecuente | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updateHistoria"></a>
# **updateHistoria**
> updateHistoria(body, id)

Actualizar o crear una historia

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.HistoriaIdBody(); // HistoriaIdBody | 
let id = 56; // Number | ID de la historia

apiInstance.updateHistoria(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**HistoriaIdBody**](HistoriaIdBody.md)|  | 
 **id** | **Number**| ID de la historia | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updateInfoContacto"></a>
# **updateInfoContacto**
> updateInfoContacto(body, id)

Actualizar o crear información de contacto por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.InfoContactoIdBody(); // InfoContactoIdBody | 
let id = 56; // Number | ID de la información de contacto

apiInstance.updateInfoContacto(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**InfoContactoIdBody**](InfoContactoIdBody.md)|  | 
 **id** | **Number**| ID de la información de contacto | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updateMantenimientoInfo"></a>
# **updateMantenimientoInfo**
> updateMantenimientoInfo(body, id)

Actualizar o crear información de mantenimiento por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.MantenimientoInfoIdBody(); // MantenimientoInfoIdBody | 
let id = 56; // Number | ID de la información de mantenimiento

apiInstance.updateMantenimientoInfo(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**MantenimientoInfoIdBody**](MantenimientoInfoIdBody.md)|  | 
 **id** | **Number**| ID de la información de mantenimiento | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updateOrCreateCategoriaServicio"></a>
# **updateOrCreateCategoriaServicio**
> updateOrCreateCategoriaServicio(body, id)

Actualizar o crear una categoría de servicio

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.CategoriaServicioIdBody(); // CategoriaServicioIdBody | 
let id = 56; // Number | ID de la categoría de servicio

apiInstance.updateOrCreateCategoriaServicio(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**CategoriaServicioIdBody**](CategoriaServicioIdBody.md)|  | 
 **id** | **Number**| ID de la categoría de servicio | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updateOrCreateEquipo"></a>
# **updateOrCreateEquipo**
> updateOrCreateEquipo(body, id)

Actualizar o crear un equipo

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.EquipoIdBody(); // EquipoIdBody | 
let id = 56; // Number | ID del equipo

apiInstance.updateOrCreateEquipo(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**EquipoIdBody**](EquipoIdBody.md)|  | 
 **id** | **Number**| ID del equipo | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

<a name="updatePreguntaFrecuente"></a>
# **updatePreguntaFrecuente**
> updatePreguntaFrecuente(body, id)

Actualizar o crear una pregunta frecuente por ID

### Example
```javascript
import {ApiDeEnergyAndWater} from 'api_de_energy_and_water';

let apiInstance = new ApiDeEnergyAndWater.DefaultApi();
let body = new ApiDeEnergyAndWater.PreguntaFrecuenteIdBody(); // PreguntaFrecuenteIdBody | 
let id = 56; // Number | ID de la pregunta frecuente

apiInstance.updatePreguntaFrecuente(body, id, (error, data, response) => {
  if (error) {
    console.error(error);
  } else {
    console.log('API called successfully.');
  }
});
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**PreguntaFrecuenteIdBody**](PreguntaFrecuenteIdBody.md)|  | 
 **id** | **Number**| ID de la pregunta frecuente | 

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

