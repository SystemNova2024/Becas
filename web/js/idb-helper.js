/* -------------------------------------------------
 * IndexedDB Helper para modo OFFLINE + SINCRONIZACIÓN
 * Base: becas-offline-db
 * Store: registros
 * Campos: id, tipo, correo, passwordHash, fecha
 ------------------------------------------------- */

const DB_NAME = "becas-offline-db";
const DB_VERSION = 3;
const STORE_NAME = "registros";

/* -------------------------------------------------
 * ABRIR BASE DE DATOS
 ------------------------------------------------- */
function openDB() {
  return new Promise((resolve, reject) => {
    const req = indexedDB.open(DB_NAME, DB_VERSION);

    req.onupgradeneeded = (e) => {
      const db = e.target.result;

      // Crear store si no existe
      if (!db.objectStoreNames.contains(STORE_NAME)) {
        const store = db.createObjectStore(STORE_NAME, {
          keyPath: "id",
          autoIncrement: true,
        });

        store.createIndex("tipo", "tipo", { unique: false });
        store.createIndex("correo", "correo", { unique: false });
      }
    };

    req.onsuccess = (e) => resolve(e.target.result);
    req.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * INSERTAR REGISTRO
 * Ejemplo uso:
 *   IDBHelper.addRecord({ tipo: "login-pendiente", correo:"...", passwordHash:"..." })
 ------------------------------------------------- */
async function addRecord(record) {
  const db = await openDB();

  return new Promise((resolve, reject) => {
    const tx = db.transaction(STORE_NAME, "readwrite");
    const store = tx.objectStore(STORE_NAME);

    const req = store.add({
      ...record,
      fecha: new Date().toISOString(),
    });

    req.onsuccess = () => resolve(req.result);
    req.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * OBTENER REGISTROS POR TIPO
 * Ejemplo:
 *   const pendientes = await IDBHelper.getRecordsByType("login-pendiente");
 ------------------------------------------------- */
async function getRecordsByType(tipo) {
  const db = await openDB();

  return new Promise((resolve, reject) => {
    const tx = db.transaction(STORE_NAME, "readonly");
    const store = tx.objectStore(STORE_NAME);
    const index = store.index("tipo");

    const req = index.getAll(tipo);

    req.onsuccess = () => resolve(req.result || []);
    req.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * OBTENER TODOS LOS REGISTROS
 ------------------------------------------------- */
async function getAllRecords() {
  const db = await openDB();

  return new Promise((resolve, reject) => {
    const tx = db.transaction(STORE_NAME, "readonly");
    const store = tx.objectStore(STORE_NAME);

    const req = store.getAll();

    req.onsuccess = () => resolve(req.result || []);
    req.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * ELIMINAR REGISTRO POR ID
 ------------------------------------------------- */
async function deleteRecord(id) {
  const db = await openDB();

  return new Promise((resolve, reject) => {
    const tx = db.transaction(STORE_NAME, "readwrite");
    tx.objectStore(STORE_NAME).delete(id);

    tx.oncomplete = () => resolve(true);
    tx.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * ELIMINAR REGISTROS POR TIPO
 * Ejemplo:
 *   await IDBHelper.deleteRecordsByType("login-pendiente");
 ------------------------------------------------- */
async function deleteRecordsByType(tipo) {
  const db = await openDB();

  return new Promise((resolve, reject) => {
    const tx = db.transaction(STORE_NAME, "readwrite");
    const store = tx.objectStore(STORE_NAME);
    const index = store.index("tipo");

    const req = index.openCursor(tipo);

    req.onsuccess = (event) => {
      const cursor = event.target.result;
      if (cursor) {
        cursor.delete();
        cursor.continue();
      } else {
        resolve(true);
      }
    };

    req.onerror = (e) => reject(e.target.error);
  });
}

/* -------------------------------------------------
 * EXPORTAR
 ------------------------------------------------- */
window.IDBHelper = {
  addRecord,
  getRecordsByType,
  getAllRecords,
  deleteRecord,
  deleteRecordsByType,
};
